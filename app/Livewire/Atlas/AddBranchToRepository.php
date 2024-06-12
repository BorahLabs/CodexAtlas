<?php

namespace App\Livewire\Atlas;

use App\Models\Repository;
use App\SourceCode\DTO\Branch;
use Livewire\Component;

class AddBranchToRepository extends Component
{
    public Repository $repository;

    public bool $isAddingBranch = false;

    public array $branches = [];

    public string $selectedBranch = '';

    public function startAddingBranch(): void
    {
        $branches = $this->getAvailableBranches();
        $existingBranches = $this->repository->branches->pluck('name')->toArray();
        $unusedBranches = collect($branches)
            ->filter(fn (Branch $branch) => ! in_array($branch->name, $existingBranches))
            ->map(fn (Branch $branch) => $branch->name)
            ->values()
            ->all();
        $this->branches = $unusedBranches;
        $this->isAddingBranch = true;
    }

    public function addBranch(): void
    {
        if (blank($this->selectedBranch)) {
            return;
        }

        $existingBranches = $this->repository->branches->pluck('name')->toArray();
        $branchAlreadyExists = in_array($this->selectedBranch, $existingBranches);
        if ($branchAlreadyExists) {
            return;
        }

        $availableBranches = $this->getAvailableBranches();
        $branchIsAvailable = collect($availableBranches)
            ->first(fn (Branch $branch) => $branch->name === $this->selectedBranch);
        if (blank($branchIsAvailable)) {
            return;
        }

        $this->repository->branches()->create([
            'name' => $this->selectedBranch,
        ]);
        $this->isAddingBranch = false;
        $this->redirect(route('projects.show', ['project' => $this->repository->project]));
    }

    private function getAvailableBranches(): array
    {
        $repoName = $this->repository->nameDto();
        $account = $this->repository->sourceCodeAccount;
        /**
         * @var \App\SourceCode\Contracts\SourceCodeProvider
         */
        $provider = $account->getProvider();
        $branches = $provider->branches($repoName);

        return $branches;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.atlas.add-branch-to-repository');
    }
}
