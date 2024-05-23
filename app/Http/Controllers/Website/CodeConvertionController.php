<?php

namespace App\Http\Controllers\Website;

use App\CodeConverter\Tools\CodeConverterTool;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CodeConvertionController extends Controller
{
    public function __invoke(string $from, string $to)
    {
        $tool = CodeConverterTool::from($from, $to);

        return view('tools.code-converter', [
            'from' => $from,
            'to' => $to,
            'tool' => $tool,
        ]);
    }
}
