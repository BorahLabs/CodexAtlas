<?php

namespace App\Actions\Internal;

use App\Actions\Codex\Architecture\SystemComponents;
use App\Jobs\DeleteAccount;
use App\Models\Branch;
use App\Models\Project;
use App\Models\ProjectConcept;
use App\Models\Repository;
use App\Models\SourceCodeAccount;
use App\Models\SystemComponent;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleDeleteAccounts
{
    use AsAction;

    public string $commandSignature = 'codex:delete-soft-users';

    public function handle()
    {
        User::query()
            ->withTrashed()
            ->whereNotNull('deleted_at')
            ->where('deleted_at', '<=', now()->subDays(30))
            ->chunkById(100, function ($users) {
                $users->each(function (User $user) {
                    DeleteAccount::dispatch($user);
                });
            });
    }
}
