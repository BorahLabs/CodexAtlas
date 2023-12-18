<?php

namespace App\Actions\Platform\ContentPlatforms;

use App\Models\SystemComponent;
use Lorisleiva\Actions\Concerns\AsAction;

class SynchronizeSystemComponent
{
    use AsAction;

    public function handle(SystemComponent $systemComponent)
    {
        $project = $systemComponent->branch->repository->project;
        $contentPlatforms = $project->contentPlatformAccounts;
        foreach ($contentPlatforms as $contentPlatformAccount) {
            /**
             * @var \App\ContentPlatform\Contracts\ContentPlatform
             */
            $provider = $contentPlatformAccount->platform->provider();
            $provider->createPage($systemComponent);
        }
    }
}
