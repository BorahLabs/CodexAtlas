<?php

namespace App\Actions\Bitbucket;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleWebhook
{
    use AsAction;

    public function handle(Request $request)
    {
        logger('entre en el post controlador');
        logger($request->toArray());
        // logger($request->toArray());
    }

    public function asController(Request $request)
    {
        $this->handle($request);

        return redirect()->route('dashboard');
    }
}
