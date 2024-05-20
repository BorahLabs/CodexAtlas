<?php

namespace App\Livewire\Atlas;

use App\Models\Project;
use App\Models\SourceCodeAccount;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddRepository extends Component
{
    public Project $project;

    public string $sourceCodeAccount;

    public SourceCodeAccount $account;

    public string $search = '';

    public array $repositories;

    public function mount()
    {
        $this->sourceCodeAccount = auth()->user()->currentTeam->sourceCodeAccounts->first()?->id ?? '';

        $this->account = SourceCodeAccount::query()->findOrFail($this->sourceCodeAccount);

        $this->getRepositories();
    }

    public function getRepositories()
    {
        $this->repositories = $this->account->getProvider()->searchRepositories($this->account, $this->search);
    }

    public function updatedSourceCodeAccount($value)
    {
        $this->account = SourceCodeAccount::query()->findOrFail($this->sourceCodeAccount);

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
