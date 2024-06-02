<?php

namespace App\Http\Controllers\Website\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CodeFixerToolController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('tools.code-fixer');
    }
}
