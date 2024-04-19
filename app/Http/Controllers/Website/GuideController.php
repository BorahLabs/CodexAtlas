<?php

namespace App\Http\Controllers\Website;

use App\Guide\DTO\MarkdownFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class GuideController extends Controller
{
    public function index()
    {
        $folders = $this->folders();

        return redirect($folders->first()['children']->first()->url());
    }

    public function show(string $folder, string $file)
    {
        $folders = $this->folders();
        $folder = $folders
            ->where(fn ($f) => $f['children']->first()?->folderId() === $folder)
            ->first();
        abort_if(is_null($folder), 404);

        $file = $folder['children']
            ->where(fn (MarkdownFile $f) => $f->id() === $file)
            ->first();
        abort_if(is_null($file), 404);

        return view('guide', [
            'folders' => $folders,
            'currentFolder' => $folder,
            'currentFile' => $file,
        ]);
    }

    public function folders(): Collection
    {
        return collect(File::directories(resource_path('guide')))
            ->map(fn (string $path) => basename($path))
            ->mapWithKeys(fn (string $folder) => [
                $folder => [
                    'name' => str($folder)->after('_')->headline()->toString(),
                    'children' => collect(File::files(resource_path("guide/{$folder}")))
                        ->map(fn (string $path) => new MarkdownFile(
                            folder: $folder,
                            path: $path,
                        )),
                ],
            ]);
    }
}
