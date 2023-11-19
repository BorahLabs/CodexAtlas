<?php

namespace App\Actions\Codex\Architecture\SystemComponents;

use App\Actions\Github\GetFile;
use App\Actions\Openai\RunUntilFinished;
use App\Enums\DocumentationSection;
use App\GitHub\File;
use App\Models\Project;
use App\Prompts\AutoDoc\SystemComponentsDescribeFile;
use Lorisleiva\Actions\Concerns\AsAction;
use OpenAI;

class ProcessSystemComponent
{
    use AsAction;

    public int $jobTries = 5;

    public int $jobMaxExceptions = 3;

    public int $jobBackoff = 180;

    public function handle(Project $project, string $owner, string $repo, File $file, int $order)
    {
        try {
            $file = GetFile::run($owner, $repo, $file->path);
            $prompt = (new SystemComponentsDescribeFile($project, $file->path, $file->contents()))->prompt();
            $client = OpenAI::client(config('services.openai.token'));

            $explanation = RunUntilFinished::make()->handle($client, $prompt);
            $extension = pathinfo($file->path, PATHINFO_EXTENSION);

            $project->documentations()->create([
                'section' => DocumentationSection::SystemComponents->value,
                'order' => $order++,
                'slug' => $file->sha,
                'title' => $file->path,
                'markdown_content' => $this->formatExplanation($explanation."\n\n```{$extension}\n".$file->contents()."\n```", $file->path),
            ]);
        } catch (\Exception $e) {
            logger()->error($e->getMessage(), [
                'file' => $file->path,
            ]);

            throw $e;
        }
    }

    private function formatExplanation(string $explanation, string $path)
    {
        $lines = explode("\n", $explanation);
        $formatted = [];
        foreach ($lines as $line) {
            if (str_starts_with($line, '# ')) {
                continue;
            }

            $formatted[] = $line;
        }

        return '# '.basename($path)."\n\n".implode("\n", $formatted);
    }
}
