<?php

namespace App\Actions\Codex\Alexandria;

use App\Alexandria\DTO\GuidePage;
use App\LLM\Contracts\Llm;
use App\Models\Branch;
use App\Models\SystemComponent;
use Borah\KnowledgeBase\Facades\KnowledgeBase;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateAnswer
{
    use AsAction;

    public string $commandSignature = 'alexandria:answer {question} {branch}';

    public function handle(string $question, Branch $branch): ?GuidePage
    {
        $components = SystemComponent::searchInKnowledgeBase($question, k: 3, where: ['branch_id' => $branch->id])
            ->models();
        /**
         * @var Llm
         */
        $llm = app(Llm::class);
        $response = $llm->completion(
            systemPrompt: "You are an expert in generating readable, useful code documentation. You will receive a question from a user, and you will return a Markdown-formatted document with the answer to the question. To help you, we will provide you some context about the project and the potentially relevant files.

Some rules:
- Reply with just the markdown document, nothing else
- If you do not know the answer, reply with the word `UNKNOWN` and NOTHING ELSE
- You can only use information from the files provided in the context
- Start the document with a nice title regarding the question. For example, if the question is `How do I create a new user?`, the title could be `# Creating a new user`",
            userPrompt: '- Question: '.$question."\n- Context: ".$components->map(fn (SystemComponent $component) => $component->content)->join("\n\n#####\n\n")."\n\n- Answer:",
        );

        if ($response->completion === 'UNKNOWN') {
            return null;
        }

        $title = explode("\n", $response->completion)[0];
        $content = str($response->completion)->after($title)->trim()->toString();
        $title = str($title)->after('#')->trim()->toString();

        return new GuidePage(
            title: $title,
            content: $content,
        );
    }

    public function asCommand(Command $command)
    {
        $branch = Branch::findOrFail($command->argument('branch'));
        $response = $this->handle($command->argument('question'), $branch);
        $command->info($response);
    }
}
