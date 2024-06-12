<?php

namespace App\Actions\Seo\CodeConverter;

use App\CodeConverter\Tools\CodeConverterTool;
use App\LLM\Contracts\Llm;
use App\LLM\PromptRequests\OpenAI\GenerateCodeConversionContentPromptRequest;
use App\Models\CodeConverterContent;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateCodeConverterContent
{
    use AsAction;

    public string $commandSignature = 'seo:generate-code-converter-content {from?} {to?} {--overwrite}';

    public function handle(string $from, string $to, bool $overwrite = false): void
    {
        $exists = CodeConverterContent::where([
            'from' => $from,
            'to' => $to,
        ])->exists();
        if (! $overwrite && $exists) {
            return;
        }

        $tool = CodeConverterTool::from($from, $to);
        $data = [
            'from' => $tool->from->name(),
            'to' => $tool->to->name(),
        ];
        /**
         * @var Llm $llm
         */
        $llm = app(Llm::class);
        $prompt = new GenerateCodeConversionContentPromptRequest();
        $response = $llm->completion($prompt->systemPrompt($data), $prompt->userPrompt($data));
        $completion = str($response->completion)
            ->when(fn (Stringable $str) => $str->contains('<markdown>'), fn (Stringable $str) => $str->after('<markdown>'))
            ->before('</markdown>')
            ->trim()
            ->prepend('## How to convert from '.$data['from'].' to '.$data['to']."\n");

        CodeConverterContent::query()->updateOrCreate([
            'from' => $from,
            'to' => $to,
        ], [
            'markdown_content' => $completion,
        ]);
    }

    public function asCommand(Command $command): int
    {
        $from = $command->argument('from');
        $to = $command->argument('to');
        $overwrite = $command->option('overwrite');

        if ($from && ! $to || ! $from && $to) {
            $command->error('You have to provide both from and to');

            return Command::INVALID;
        }

        if ($from && $to) {
            static::dispatch($from, $to, $overwrite);

            return Command::SUCCESS;
        }

        collect(CodeConverterTool::all())
            ->each(fn (CodeConverterTool $tool) => static::dispatch(Str::slug($tool->from->name()), Str::slug($tool->to->name()), $overwrite));

        return Command::SUCCESS;
    }
}
