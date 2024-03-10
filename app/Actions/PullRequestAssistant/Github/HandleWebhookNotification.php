<?php

namespace App\Actions\PullRequestAssistant\Github;

use App\Enums\GithubWebhookEvents;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleWebhookNotification
{
    use AsAction;

    public function handle(Request $request)
    {
        $event = $request->header('X-Github-Event');
        return match($event) {
            GithubWebhookEvents::PULL_REQUEST_COMMENT->value => HandlePullRequestComment::run($request),
            default => null
        };
    }
}
