<?php

namespace App\Actions\AutoDoc\Architecture;

use App\Actions\Github\GetFile;
use App\Actions\Openai\RunUntilFinished;
use App\Models\Project;
use App\Prompts\AutoDoc\TechnologyStackDescription;
use Lorisleiva\Actions\Concerns\AsAction;
use OpenAI;

class TechnologyStack
{
    use AsAction;

    public function handle(Project $project)
    {
        $files = [
            'composer.json',
            'package.json',
            'requirements.txt',
            'Gemfile',
            'Podfile',
            'pom.xml',
            'build.gradle',
            'build.gradle.kts',
            'build.sbt',
            'mix.exs',
            'Cargo.toml',
            'go.mod',
            'go.sum',
            'pubspec.yaml',
        ];

        [$owner, $repo] = explode('/', $project->github_repository);
        $dependencies = [];
        foreach ($files as $fileName) {
            try {
                $file = GetFile::run($owner, $repo, $fileName);
                $dependencies[$fileName] = $file->contents();
            } catch (\Exception $e) {
                // ignore
            }
        }

        if (empty($dependencies)) {
            return;
        }

        $prompt = (new TechnologyStackDescription($dependencies))->prompt();
        $response = $this->getResponse($prompt);
        $project->update([
            'technology_stack' => $response,
        ]);
    }

    private function getResponse(string $prompt)
    {
        $client = OpenAI::client(config('services.openai.token'));

        $explanation = RunUntilFinished::make()->handle(
            client: $client,
            prompt: $prompt,
            params: [
                'temperature' => 0.15,
            ]
        );
        $explanation = trim(preg_replace('/^# .*$/m', '', $explanation));

        return $explanation;
    }
}
