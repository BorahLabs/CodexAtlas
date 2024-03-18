<?php

namespace App\Livewire;

use App\Models\Project;
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
}
