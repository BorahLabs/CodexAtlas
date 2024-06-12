<?php

namespace App\Actions\Platform\Tools;

use Lorisleiva\Actions\Concerns\AsAction;

class ShowCodeConversion
{
    use AsAction;

    public function handle(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('tools.app.code-converter');
    }
}
