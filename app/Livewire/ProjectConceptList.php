<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\ProjectConcept;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectConceptList extends Component
{
    public Project $project;

    #[On('project-concept-created')]
    public function updateList()
    {
        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.project-concept-list');
    }

    public function deleteConcept($concept)
    {
        ProjectConcept::query()->where('id', $concept)->delete();

        $this->dispatch('$refresh');

    }
}
