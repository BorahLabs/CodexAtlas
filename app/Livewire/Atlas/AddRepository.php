<?php

namespace App\Livewire\Atlas;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\SourceCode\BitbucketProvider;
use App\SourceCode\DTO\Repository;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddRepository extends Component
{
    public Project $project;

    public string $sourceCodeAccount;

    public SourceCodeAccount $account;

    public string $search = '';

    public array $repositories;

    public array $bitbucketWorkspaces = [];

    public array $bitbucketRepositories = [];

    public string $bitbucketWorkspace = '';

    public string $bitbucketRepository = '';

    public function mount(): void
    {
        $this->sourceCodeAccount = auth()->user()->currentTeam->sourceCodeAccounts->first()?->id ?? '';

        if ($this->sourceCodeAccount) {
            $this->account = SourceCodeAccount::query()->findOrFail($this->sourceCodeAccount);

            $this->getRepositories();
        }
    }

    public function getRepositories(): void
    {
        $provider = $this->account->getProvider();
        try {

            if ($provider instanceof BitbucketProvider) {
                $this->bitbucketWorkspaces = $provider->searchWorkspaces($this->account, $this->search);

                $this->repositories = [];
            } else {
                $this->bitbucketWorkspaces = [];
                $this->bitbucketRepositories = [];

                $this->repositories = $provider->searchRepositories($this->account, $this->search);
            }
        } catch (\Exception $e) {
            logger()->error($e);
            $this->repositories = [];
            LogUserPerformedAction::dispatch(
                \App\Enums\Platform::Codex,
                \App\Enums\NotificationType::Error,
                'Error searching repositories',
                [
                    'account' => $this->account->id,
                    'search' => $this->search,
                    'error' => $e->getMessage(),
                ]
            );
        }
    }

    public function updatedBitbucketWorkspace(mixed $value): void
    {
        $this->bitbucketRepository = '';

        $this->bitbucketRepositories = $this->account->getProvider()->searchRepositories($this->account, $value);
    }

    public function updatedSourceCodeAccount(mixed $value): void
    {
        $this->account = SourceCodeAccount::query()->findOrFail($this->sourceCodeAccount);
        $this->search = '';

        $this->getRepositories();
    }

    public function updatedSearch(mixed $value): void
    {
        $this->getRepositories();
    }

    #[Computed()]
    public function accountRepositories(): array
    {
        try {
            $validAccounts = auth()->user()->currentTeam->sourceCodeAccounts->pluck('id')->toArray();
            if (! in_array($this->sourceCodeAccount, $validAccounts)) {
                return [];
            }

            /**
             * @var SourceCodeAccount $account
             */
            $account = SourceCodeAccount::query()->findOrFail($this->sourceCodeAccount);
            $provider = $account->getProvider();
            $repositories = cache()->remember('repository-list:'.$account->id, now()->addMinutes(5), fn () => $provider->repositories());
            usort($repositories, fn (Repository $a, Repository $b) => $a->fullName <=> $b->fullName);

            return $repositories;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.atlas.add-repository');
    }
}
