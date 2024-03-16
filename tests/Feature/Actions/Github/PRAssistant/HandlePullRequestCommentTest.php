<?php

use App\Actions\PullRequestAssistant\Github\HandlePullRequestComment;
use App\Actions\PullRequestAssistant\Github\SendRequestToLLM;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Exception;




it('Can push new content from AI reponse to Github', function () {

    $user = User::factory()->inUnlimitedCompanyPlanMode()->create();
    Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    SourceCodeAccount::factory()->prAssistantGithub()->create([
        'team_id' => $user->currentTeam->id,
    ]);

    $jsonPayload = [
        'action' => 'created',
        'repository' => [
            'name' => 'test-pr-assistant',
            'owner' => [
                'login' => 'ismaelilloDev'
            ]
        ],
        'pull_request' => [
            'head' => [
                'ref' => 'feature_change_return_response'
            ]
        ],
        'comment' => [
            'body' => '/codex change route to /test/'.Str::random(6),
            'path' => 'routes/web.php',
            'start_line' => 20,
            'line' => 22
        ]
    ];
    $jsonString = json_encode($jsonPayload);
    $request = Request::create('/', 'POST', $jsonPayload);
    $decodedContent = json_decode($jsonString, true);
    $request->merge($decodedContent);
    expect(HandlePullRequestComment::run($request))->toBe(true);
});

it('Dont push new content from AI reponse to Github when comment action is not created', function () {

    $user = User::factory()->inUnlimitedCompanyPlanMode()->create();
    Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    SourceCodeAccount::factory()->prAssistantGithub()->create([
        'team_id' => $user->currentTeam->id,
    ]);

    $jsonPayload = [
        'action' => 'deleted',
        'repository' => [
            'name' => 'test-pr-assistant',
            'owner' => [
                'login' => 'ismaelilloDev'
            ]
        ],
        'pull_request' => [
            'head' => [
                'ref' => 'feature_change_return_response'
            ]
        ],
        'comment' => [
            'body' => '/codex change route to /test/'.Str::random(6),
            'path' => 'routes/web.php',
            'start_line' => 20,
            'line' => 22
        ]
    ];
    $jsonString = json_encode($jsonPayload);
    $request = Request::create('/', 'POST', $jsonPayload);
    $decodedContent = json_decode($jsonString, true);
    $request->merge($decodedContent);
    expect(HandlePullRequestComment::run($request))->toBe(false);
});

it('Dont push new content from AI reponse to Github when comment does not start with /codex', function () {

    $user = User::factory()->inUnlimitedCompanyPlanMode()->create();
    Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    SourceCodeAccount::factory()->prAssistantGithub()->create([
        'team_id' => $user->currentTeam->id,
    ]);

    $jsonPayload = [
        'action' => 'created',
        'repository' => [
            'name' => 'test-pr-assistant',
            'owner' => [
                'login' => 'ismaelilloDev'
            ]
        ],
        'pull_request' => [
            'head' => [
                'ref' => 'feature_change_return_response'
            ]
        ],
        'comment' => [
            'body' => '/test change route to /test/'.Str::random(6),
            'path' => 'routes/web.php',
            'start_line' => 20,
            'line' => 22
        ]
    ];
    $jsonString = json_encode($jsonPayload);
    $request = Request::create('/', 'POST', $jsonPayload);
    $decodedContent = json_decode($jsonString, true);
    $request->merge($decodedContent);
    expect(HandlePullRequestComment::run($request))->toBe(false);
});

it('Dont push new content from AI reponse to Github when invalid line range', function () {

    $user = User::factory()->inUnlimitedCompanyPlanMode()->create();
    Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    SourceCodeAccount::factory()->prAssistantGithub()->create([
        'team_id' => $user->currentTeam->id,
    ]);

    $jsonPayload = [
        'action' => 'created',
        'repository' => [
            'name' => 'test-pr-assistant',
            'owner' => [
                'login' => 'ismaelilloDev'
            ]
        ],
        'pull_request' => [
            'head' => [
                'ref' => 'feature_change_return_response'
            ]
        ],
        'comment' => [
            'body' => '/codex change route to /test/'.Str::random(6),
            'path' => 'routes/web.php',
            'start_line' => null,
            'line' => 22
        ]
    ];
    $jsonString = json_encode($jsonPayload);
    $request = Request::create('/', 'POST', $jsonPayload);
    $decodedContent = json_decode($jsonString, true);
    $request->merge($decodedContent);
    expect(fn() => HandlePullRequestComment::run($request))->toThrow(Exception::class);
});

it('Dont push new content from AI invalid reponse', function () {

    SendRequestToLLM::mock()->shouldReceive('handle')->andReturn([]);

    $user = User::factory()->inUnlimitedCompanyPlanMode()->create();
    Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    SourceCodeAccount::factory()->prAssistantGithub()->create([
        'team_id' => $user->currentTeam->id,
    ]);

    $jsonPayload = [
        'action' => 'created',
        'repository' => [
            'name' => 'test-pr-assistant',
            'owner' => [
                'login' => 'ismaelilloDev'
            ]
        ],
        'pull_request' => [
            'head' => [
                'ref' => 'feature_change_return_response'
            ]
        ],
        'comment' => [
            'body' => '/codex change route to /test/'.Str::random(6),
            'path' => 'routes/web.php',
            'start_line' => 20,
            'line' => 22
        ]
    ];
    $jsonString = json_encode($jsonPayload);
    $request = Request::create('/', 'POST', $jsonPayload);
    $decodedContent = json_decode($jsonString, true);
    $request->merge($decodedContent);
    expect(HandlePullRequestComment::run($request))->toBe(false);
});

it('Dont push new content from when invalid gh credentials', function () {

    $jsonPayload = [
        'action' => 'created',
        'repository' => [
            'name' => 'test-pr-assistant',
            'owner' => [
                'login' => 'ismaelilloDev'
            ]
        ],
        'pull_request' => [
            'head' => [
                'ref' => 'feature_change_return_response'
            ]
        ],
        'comment' => [
            'body' => '/codex change route to /test/'.Str::random(6),
            'path' => 'routes/web.php',
            'start_line' => 20,
            'line' => 22
        ]
    ];
    $jsonString = json_encode($jsonPayload);
    $request = Request::create('/', 'POST', $jsonPayload);
    $decodedContent = json_decode($jsonString, true);
    $request->merge($decodedContent);
    expect(fn() => HandlePullRequestComment::run($request))->toThrow(Exception::class);
});
