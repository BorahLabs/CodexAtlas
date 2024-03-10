<?php

namespace App\Enums;

enum GithubWebhookEvents: string
{
    case PULL_REQUEST_COMMENT = 'pull_request_review_comment';
}
