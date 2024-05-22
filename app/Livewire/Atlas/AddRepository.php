<?php

namespace App\Livewire\Atlas;

use App\Actions\Bitbucket\SearchWorkspaces;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Enums\SourceCodeProvider;
use App\SourceCode\BitbucketProvider;

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

        $this->account = SourceCodeAccount::query()->findOrFail($this->sourceCodeAccount);

        $this->getRepositories();
    }

    public function getRepositories()
    {
        if($this->account->provider == SourceCodeProvider::Bitbucket){
            $this->bitbucketWorkspaces = $this->account->getProvider()->searchWorkspaces($this->account, $this->search);

            $this->repositories = [];
        } else{
            $this->bitbucketWorkspaces = [];
            $this->bitbucketRepositories = [];

            $this->repositories = $this->account->getProvider()->searchRepositories($this->account, $this->search);
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
            if (!in_array($this->sourceCodeAccount, $validAccounts)) {
                return [];
            }

            /**
             * @var SourceCodeAccount $account
             */
            $account = SourceCodeAccount::query()->findOrFail($this->sourceCodeAccount);
            $provider = $account->getProvider();
            $repositories = cache()->remember('repository-list:' . $account->id, now()->addMinutes(5), fn () => $provider->repositories());
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
