<?php

namespace App\Actions\Platform\ContentPlatforms;

use App\Enums\ContentPlatformAction;
use App\Models\ContentPlatformAccount;
use App\Models\ContentPlatformAccountProject;
use App\Models\SystemComponent;
use Lorisleiva\Actions\Concerns\AsAction;

class SynchronizeSystemComponent
{
    use AsAction;

    public function handle(SystemComponent|string $systemComponent, ?ContentPlatformAction $action = null)
    {
        if (is_string($systemComponent)) {
            $systemComponent = SystemComponent::query()->withTrashed()->findOrFail($systemComponent);
        }

        $project = $systemComponent->branch->repository->project;
        $contentPlatforms = $project->contentPlatformAccounts;
        foreach ($contentPlatforms as $contentPlatformAccount) {
            /**
             * @var \App\ContentPlatform\Contracts\ContentPlatform
             */
            $provider = $contentPlatformAccount->platform->provider();
            $accountProject = ContentPlatformAccountProject::where([
                'project_id' => $project->id,
                'content_platform_account_id' => $contentPlatformAccount->id,
            ])->firstOrFail();
            $action ??= $this->inferActionFor($systemComponent, $accountProject);
            $provider
                ->with($accountProject)
                ->update($systemComponent, $action);
        }
    }

    protected function inferActionFor(SystemComponent $systemComponent, ContentPlatformAccountProject $account): ContentPlatformAction
    {
        // TODO: si el system component tiene un registro en la tabla X, devuelves Update. Si no, devuelves create
        if ($systemComponent->externalContentPageId($account)) {
            return ContentPlatformAction::Update;
        }

        return ContentPlatformAction::Create;
    }
}
