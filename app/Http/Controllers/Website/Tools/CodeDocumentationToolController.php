<?php

namespace App\Http\Controllers\Website\Tools;

use App\Atlas\Guesser;
use App\Atlas\Languages\Contracts\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CodeDocumentationToolController extends Controller
{
    public function __invoke(string $language, Request $request)
    {
        $language = collect(Guesser::supportedLanguages())->first(fn (Language $lang) => str($lang->name())->slug()->is($language));
        abort_unless($language, 404);

        return view('tools.code-documentation', [
            'language' => $language,
        ]);
    }
}
