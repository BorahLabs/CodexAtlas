<?php

namespace App\Actions\Platform;

use App\Models\Branch;
use App\Models\Project;
use App\Models\Repository;
use App\Models\SystemComponent;
use Lorisleiva\Actions\Concerns\AsAction;
use ZipArchive;

class DownloadDocsAsMarkdown
{
    use AsAction;

    public function handle(Project $project, Repository $repository, Branch $branch): string
    {
        $zip = new ZipArchive();
        $path = tempnam(sys_get_temp_dir(), 'docs').'.zip';
        if (! $zip->open($path, ZipArchive::CREATE)) {
            throw new \Exception('Could not create zip file');
        }

        $readme = GetReadme::make()->handle($repository, $branch);
        if ($readme) {
            $zip->addFromString('README.md', $readme->contents());
        }

        $branch
            ->systemComponents()
            ->each(fn (SystemComponent $systemComponent) => $zip->addFromString($systemComponent->path.'.md', $systemComponent->content));

        $zip->close();

        return $path;
    }

    public function asController(Project $project, Repository $repository, Branch $branch)
    {
        $zipPath = $this->handle($project, $repository, $branch);

        return response()->download($zipPath, $repository->name.'-'.$branch->name.'.zip');
    }
}
