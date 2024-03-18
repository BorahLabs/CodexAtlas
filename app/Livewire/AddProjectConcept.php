<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\ProjectConcept;
use Illuminate\Support\Facades\Route;
use LivewireUI\Modal\ModalComponent;

class AddProjectConcept extends ModalComponent
{
    public ?Project $project = null;
    public ?ProjectConcept $concept = null;
    public $name;
    public $description;
    public bool $createAnother;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'required',
    ];

    public function mount()
    {
        if($this->concept){
            $this->name = $this->concept->name;
            $this->description = $this->concept->description;
        }
    }

    public function render()
    {
        $this->createAnother = false;
        return view('livewire.add-project-concept');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function save()
    {
        $this->validate();

        if($this->concept){
            $this->concept->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
        } else{
            ProjectConcept::create([
                'project_id' => $this->project->id,
                'name' => $this->name,
                'description' => $this->description,
                'order' => 0
            ]);
        }

        $this->dispatch('project-concept-created');

        if($this->createAnother){
            $this->clearInputs();
        } else{
            $this->forceClose()->closeModal();
        }
    }

    public function clearInputs()
    {
        $this->name = "";
        $this->description = "";
    }

    public function clearName()
    {
        $this->name = "";
    }

    public function saveAndCreateAnother()
    {
        $this->createAnother = true;
        $this->save();
    }

    public function deleteConcept()
    {
        $this->concept->delete();

        $this->dispatch('project-concept-created');

        $this->forceClose()->closeModal();
    }
}
