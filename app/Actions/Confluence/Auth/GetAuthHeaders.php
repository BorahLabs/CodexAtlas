<?php

namespace App\Actions\Confluence\Auth;

use Lorisleiva\Actions\Concerns\AsAction;

class GetAuthHeaders
{
    use AsAction;

    public function handle()
    {
        return array(
          'Accept' => 'application/json',
          'Content-Type' => 'application/json'
        );
    }
}
