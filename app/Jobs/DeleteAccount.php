<?php

namespace App\Jobs;

use App\Models\Branch;
use App\Models\Project;
use App\Models\ProjectConcept;
use App\Models\Repository;
use App\Models\SourceCodeAccount;
use App\Models\SystemComponent;
use App\Models\Team;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DeleteAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $teams = $this->user->ownedTeams()->withTrashed()->with('repositories.branches', 'sourceCodeAccounts', 'projects.concepts')->where('user_id', $this->user->id)->get();

        // 1. SYSYTEM COMPONENTS
        $repos = $teams->pluck('repositories')->flatten();
        $reposIds = $repos->pluck('id')->toArray();

        $branches = $repos->pluck('branches')->flatten();
        $branchesIds = $branches->pluck('id')->toArray();

        $this->deleteInBatches(SystemComponent::class, 'branch_id', $branchesIds);

        $this->deleteInBatches(Branch::class, 'id', $branchesIds);

        $this->deleteInBatches(Repository::class, 'id', $reposIds, true);

        // 2. SOURCECODEACCOUNTS
        $sourceCodeAccounts = $teams->pluck('sourceCodeAccounts')->flatten();
        $sourceCodeAccountsIds = $sourceCodeAccounts->pluck('id')->toArray();

        $this->deleteInBatches(SourceCodeAccount::class, 'id', $sourceCodeAccountsIds, true);

        // 3. PROJECTS
        $projects = $teams->pluck('projects')->flatten();
        $projectsIds = $projects->pluck('id')->toArray();

        $concepts = $projects->pluck('concepts')->flatten();
        $conceptsIds = $concepts->pluck('id')->toArray();

        $this->deleteInBatches(ProjectConcept::class, 'id', $conceptsIds);

        $this->deleteInBatches(Project::class, 'id', $projectsIds, true);

        // 4. TEAMs
        $teams->each->forceDelete();

        // 5. USER
        $userId = $this->user->id;
        $email = $this->user->old_email;

        $this->user->forceDelete();

        Log::channel('user-deleted')->info('User deleted with email -> ' . $email . ' and id -> ' . $userId);
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [new WithoutOverlapping($this->user->id)];
    }

    /**
     * Delete records in 100 chunks.
     *
     * @param string $modelClass
     * @param string $column
     * @param array $ids
     * @return void
     */
    private function deleteInBatches(string $modelClass, string $column, array $ids, bool $forceDelete = false)
    {
        do {
            $query = $modelClass::query()
                ->whereIn($column, $ids)
                ->limit(100);

            if ($forceDelete && method_exists($modelClass, 'forceDelete')) {
                $deleted = $query->get()->each->forceDelete()->count();
            } else {
                $deleted = $query->delete();
            }
        } while ($deleted > 0);
    }
}
