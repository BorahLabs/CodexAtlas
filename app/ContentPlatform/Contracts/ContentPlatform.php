<?php

namespace App\ContentPlatform\Contracts;

use App\ContentPlatform\Contracts\AuthenticatesUser;
use App\Enums\ContentPlatformAction;
use App\Models\BranchContentPlatformFolder;
use App\Models\ContentPlatformAccountProject;
use App\Models\ContentPlatformAccountSystemComponent;
use App\Models\SystemComponent;

abstract class ContentPlatform
{
    protected ?ContentPlatformAccountProject $account;

    public function with(ContentPlatformAccountProject $account): static
    {
        $this->account = $account;
        if ($this instanceof AuthenticatesUser) {
            $this->authenticate();
        }

        return $this;
    }

    public function update(SystemComponent $systemComponent, ContentPlatformAction $action)
    {
        $folderId = $this->folder($systemComponent)?->external_id;
        if (! $folderId) {
            $folderId = $this->createFolder($systemComponent);

            BranchContentPlatformFolder::create([
                'external_id' => $folderId,
                'branch_id' => $systemComponent->branch_id,
                'content_platform_account_id' => $this->account->content_platform_account_id,
            ]);
        }
        $pageId = $systemComponent->externalContentPageId($this->account)?->external_id;
        switch ($action) {
            case ContentPlatformAction::Create:
                $response = $pageId ?? $this->createPage($folderId, $systemComponent);
                ContentPlatformAccountSystemComponent::create([
                    'content_platform_account_id' => $this->account->content_platform_account_id,
                    'system_component_id' => $systemComponent->id,
                    'external_id' => $response,
                ]);
                // TODO: crear registro en bd
                return $response;
            case ContentPlatformAction::Update:
                return $pageId && $this->updatePage($folderId, $systemComponent);
            case ContentPlatformAction::Delete:
                // todo: eliminar registro de bd
                return $pageId && $this->deletePage($systemComponent);
        }
    }

    public function folder(SystemComponent $systemComponent): ?BranchContentPlatformFolder
    {
        return BranchContentPlatformFolder::where([
            'branch_id' => $systemComponent->branch_id,
            'content_platform_account_id' => $this->account->content_platform_account_id,
        ])->first();
    }

    abstract public function createFolder(SystemComponent $systemComponent): string;

    abstract public function createPage(string $folderId, SystemComponent $systemComponent);

    abstract public function updatePage(string $folderId, SystemComponent $systemComponent);

    abstract public function deletePage(SystemComponent $systemComponent);
}
