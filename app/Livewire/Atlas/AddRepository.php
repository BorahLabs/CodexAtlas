<?php

namespace App\Livewire\Atlas;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Enums\SourceCodeProvider;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\SourceCode\BitbucketProvider;
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

    public function mount()
    {
        $this->sourceCodeAccount = auth()->user()->currentTeam->sourceCodeAccounts->first()?->id ?? '';

        if ($this->sourceCodeAccount) {
            $this->account = SourceCodeAccount::query()->findOrFail($this->sourceCodeAccount);

            $this->getRepositories();
        }
    }

    public function getRepositories()
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

    public function updatedBitbucketWorkspace($value)
    {
        $this->bitbucketRepository = '';

        $this->bitbucketRepositories = $this->account->getProvider()->searchRepositories($this->account, $value);
    }

    public function updatedSourceCodeAccount($value)
    {
        $this->account = SourceCodeAccount::query()->findOrFail($this->sourceCodeAccount);
        $this->search = '';

        $this->getRepositories();
    }

    public function updatedSearch($value)
    {
        $this->getRepositories();
    }

    #[Computed()]
    public function accountRepositories()
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
            usort($repositories, fn ($a, $b) => $a->fullName <=> $b->fullName);

            return $repositories;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function render()
    {
        return view('livewire.atlas.add-repository');
    }
}
