<?php

namespace App\Actions\Codex\Readme;

use Illuminate\Support\Facades\Http;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateOfflineReadme
{
    use AsAction;

    public function handle(TemporaryUploadedFile $zip): string
    {
        $response = Http::attach('zip_file', $zip->get(), $zip->getClientOriginalName(), [
            'Content-Type' => 'application/zip',
        ])
            ->post(config('services.readme_generator.endpoint.offline'))
            ->throw()
            ->json('readme');
        throw_if(empty($response), new \Exception('Failed to generate readme. Please, make sure the zip file contains a valid project.'));

        return $response;
    }
}
