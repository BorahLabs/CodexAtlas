<?php

namespace App\Actions\Gitlab;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleWebhook
{
    use AsAction;

    public function handle(Request $request, $uuid)
    {
        logger('entre en el post controlador para gitlab');
        logger($uuid);
        logger($request->toArray());
        // logger($request->toArray());
    }

    public function asController(Request $request, $uuid)
    {
        $this->handle($request, $uuid);

        return redirect()->route('dashboard');
    }
}
