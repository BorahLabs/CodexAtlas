<?php

namespace App\Http\Controllers\Website\Tools;

use App\Http\Controllers\Controller;

class ReadmeGeneratorToolController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('tools.readme-generator');
    }
}
