<?php

namespace App\Actions\Autodoc;

use App\Enums\SystemComponentStatus;
use App\Models\AutodocLead;
use App\Models\SystemComponent;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsController;

class ShowStatus
{
    use AsController;

    public function asController(AutodocLead $autodocLead, Request $request)
    {
        return view('autodoc.status', [
            'autodocLead' => $autodocLead,
        ]);
    }
}
