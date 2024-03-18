<?php

namespace App\Enums;

enum GithubWebhookEvents: string
{
    case PING = 'ping';
    case PUSH = 'push';
    case PULL_REQUEST_COMMENT = 'pull_request_review_comment';
}
