<?php

namespace App\Actions\Autodoc;

use App\Models\AutodocLead;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsController;

class ShowStatus
{
    use AsController;

    public function asController(AutodocLead $autodocLead, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('autodoc.status', [
            'autodocLead' => $autodocLead,
        ]);
    }
}
