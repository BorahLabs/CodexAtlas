<?php

namespace App\Actions\Autodoc;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use ZipArchive;

class ExtractZip
{
    use AsAction;

    public function handle(string $localFilePath, string $baseName): string
    {
        $local = Storage::disk('tmp');
        $s3 = Storage::disk('s3');
        $filePath = $local->path($localFilePath);
        $absolutePath = $local->path($baseName);
        if ($local->exists($baseName)) {
            return $baseName;
        }

        $zip = new ZipArchive();
        $res = $zip->open($filePath);
        if ($res !== true) {
            throw new \Exception('Could not open zip file');
        }


        $zip->extractTo($absolutePath);
        $zip->close();

        if (! $s3->exists($localFilePath)) {
            $s3->put($localFilePath, $local->get($localFilePath));
        }

        $local->delete($localFilePath);

        return $baseName;
    }
}
