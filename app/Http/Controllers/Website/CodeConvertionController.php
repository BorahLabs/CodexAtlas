<?php

namespace App\Http\Controllers\Website;

use App\CodeConverter\Tools\CodeConverterTool;
use App\Http\Controllers\Controller;

class CodeConvertionController extends Controller
{
    public function __invoke(string $from, string $to): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $tool = CodeConverterTool::from($from, $to);

        return view('tools.code-converter', [
            'from' => $from,
            'to' => $to,
            'tool' => $tool,
        ]);
    }
}
