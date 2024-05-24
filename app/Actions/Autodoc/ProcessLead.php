<?php

namespace App\Actions\Autodoc;

use App\Actions\Codex\Architecture\FilterFilesByFramework;
use App\Enums\SystemComponentStatus;
use App\Models\AutodocLead;
use App\Models\Project;
use App\Models\SystemComponent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class ProcessLead
{
    use AsAction;

    public string $commandSignature = 'autodoc:process-lead {lead}';

    public function handle(AutodocLead $lead)
    {
        $s3 = Storage::disk('s3');
        $local = Storage::disk('tmp');
        $local->writeStream($lead->zip_path, $s3->readStream($lead->zip_path));
        $baseName = str(basename($lead->zip_path))->beforeLast('.zip')->toString();
        $folderPath = ExtractZip::make()->handle($lead->zip_path, $baseName);
        [$repoName, $filesAndFolders] = GetFiles::make()->handle($baseName);
        [$framework, $files] = FilterFilesByFramework::make()->handle($filesAndFolders, $repoName);

        $project = Project::query()->where('id', config('autodoc.project_id'))->first();
        $account = $project->team->sourceCodeAccounts()->withoutGlobalScopes()->first();
        /**
         * @var \App\Models\Repository $repository
         */
        $repository = $account->repositories()->createQuietly([
            'project_id' => $project->id,
            'name' => $baseName,
            'username' => 'Autodoc',
        ]);

        /**
         * @var \App\Models\Branch $branch
         */
        $branch = $repository->branches()->createQuietly([
            'name' => 'main',
        ]);
        $components = [];
        foreach ($files as $i => $file) {
            $components[] = [
                'id' => Str::uuid(),
                'branch_id' => $branch->id,
                'order' => $i,
                'path' => $file->path,
                'sha' => $file->sha,
                'file_contents' => Crypt::encryptString($file->contents()),
                'markdown_docs' => null,
                'status' => SystemComponentStatus::Pending->value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $s3->delete($lead->zip_path);
        $local->deleteDirectory($folderPath);

        // bulk insert so it does not trigger any event
        SystemComponent::insert($components);

        $lead->update([
            'branch_id' => $branch->id,
        ]);

        $branch->systemComponents()->each(fn (SystemComponent $systemComponent) => ProcessAutodocSystemComponent::dispatch($systemComponent, $lead));
    }

    public function asCommand(Command $command)
    {
        $lead = AutodocLead::findOrFail($command->argument('lead'));
        $this->handle($lead);
    }
}
