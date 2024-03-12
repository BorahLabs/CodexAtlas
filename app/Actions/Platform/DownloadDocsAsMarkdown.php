<?php

namespace App\Actions\Platform;

use App\Models\Branch;
use App\Models\CustomGuide;
use App\Models\Project;
use App\Models\Repository;
use App\Models\SystemComponent;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

class DownloadDocsAsMarkdown
{
    use AsAction;

    public function handle(Project $project, Repository $repository, Branch $branch, bool $withReadme = true): string
    {
        $zip = new ZipArchive();
        $path = tempnam(sys_get_temp_dir(), 'docs').'.zip';
        if (! $zip->open($path, ZipArchive::CREATE)) {
            throw new \Exception('Could not create zip file');
        }

        if ($withReadme) {
            $readme = GetReadme::make()->handle($repository, $branch);
            if ($readme) {
                $zip->addFromString('README.md', $readme->contents());
            }
        }

        $branch
            ->systemComponents()
            ->each(fn (SystemComponent $systemComponent) => $zip->addFromString($systemComponent->path.'.md', $systemComponent->content));

        $branch->customGuides()
            ->each(fn (CustomGuide $customGuide) => $zip->addFromString(str(basename($customGuide->title))->slug()->append('.md')->prepend('custom-guides/')->toString(), $customGuide->content));

        $zip->close();

        return $path;
    }

    public function asController(Project $project, Repository $repository, Branch $branch): BinaryFileResponse
    {
        $zipPath = $this->handle($project, $repository, $branch);

        return response()
            ->download($zipPath, $repository->name.'-'.$branch->name.'.zip')
            ->deleteFileAfterSend();
    }
}
