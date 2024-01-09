<?php

namespace App\ContentPlatform;

use App\Actions\Confluence\Auth\GetAuthHeaders;
use App\ContentPlatform\Contracts\ContentPlatform;
use App\ContentPlatform\Contracts\AuthenticatesUser;
use App\Enums\ConfluenceApiCalls;
use App\Models\SystemComponent;
use Illuminate\Support\Str;
use Unirest\Request;

class ConfluenceContentPlatform extends ContentPlatform implements AuthenticatesUser
{

    protected function getAuthHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function authenticate()
    {
        Request::auth($this->account->contentPlatformAccount->email, $this->account->contentPlatformAccount->access_token);
    }

    public function createFolder(SystemComponent $systemComponent): string
    {
        $headers = $this->getAuthHeaders();
        $apiCall = ConfluenceApiCalls::CreateFolder->endpoint($this->account->contentPlatformAccount->domain);

        $spaceId = $this->account->space_id;
        $parentId = $this->account->parent_id;
        $name = $systemComponent->branch->name;

        $body = json_encode([
            'spaceId' => "$spaceId",
            'status' => 'current',
            'parentId' => "$parentId",
            'title' => "$name",
            'private' => true,
            'body' => [
                'representation' => 'storage',
                'value' => '',
            ],
            'metadata' => [
                'properties' => [
                    'content-template' => ['value' => ['key' => 'com.atlassian.confluence.plugins.confluence-content-template:folder']],
                ],
            ],
        ]);

        $response = Request::post($apiCall, $headers, $body);

        return $response->body->id;
    }

    public function createPage(string $folderId, SystemComponent $systemComponent)
    {
        $headers = $this->getAuthHeaders();
        $apiCall = ConfluenceApiCalls::CreatePage->endpoint($this->account->contentPlatformAccount->domain);

        $content = Str::markdown($systemComponent->content);

        $spaceId = $this->account->space_id;

        $pageTitle = $systemComponent->path;

        $body = json_encode([
            'spaceId' => "$spaceId",
            'status' => 'current',
            'title' => "$pageTitle",
            'parentId' => "$folderId",
            'private' => true,
            'body' => [
                'representation' => 'storage',
                'value' => "$content",
            ],
        ]);

        $response = Request::post($apiCall, $headers, $body);

        return $response->body->id;
    }

    public function updatePage(string $folderId, SystemComponent $systemComponent)
    {
        $headers = $this->getAuthHeaders();

        $pageId = $systemComponent->externalContentPageId($this->account)->external_id;

        $apiCall = ConfluenceApiCalls::GetPage->endpoint($this->account->contentPlatformAccount->domain, $pageId);

        $page = Request::get($apiCall, $headers);
        $version = $page->body->version->number;

        $apiCall = ConfluenceApiCalls::UpdatePage->endpoint($this->account->contentPlatformAccount->domain, $pageId);

        $message = 'Updated by '.config('app.name');
        $content = Str::markdown($systemComponent->content);
        $newVersion = $version++;
        $pageTitle = $systemComponent->path;

        $body = json_encode([
            'id' => "$pageId",
            'status' => 'current',
            'parentId' => $folderId,
            'title' => "$pageTitle",
            'private' => true,
            'body' => [
                'representation' => 'storage',
                'value' => "$content",
            ],
            'version' => [
                'number' => $newVersion,
                'message' => "$message",
            ],
        ]);

        $response = Request::put($apiCall, $headers, $body);

        return $response->body->id;
    }

    public function deletePage(SystemComponent $systemComponent)
    {
        $pageId = $systemComponent->externalContentPageId($this->account)->external_id;
        $apiCall = ConfluenceApiCalls::DeletePage->endpoint($this->account->contentPlatformAccount->domain, $pageId);
        $response = Request::delete($apiCall);

        return $response;
    }
}
