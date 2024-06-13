<?php

namespace App\Livewire\Glossary;

use App\Models\ProjectConcept;
use LivewireUI\Modal\ModalComponent;

class DeleteConfirmationModal extends ModalComponent
{
    public ProjectConcept $concept;

    public function render()
    {
        return view('livewire.glossary.delete-confirmation-modal');
    }

    public function confirm()
    {
        $this->concept->delete();

        $this->dispatch('close-add-project-modal');
        $this->dispatch('sync-project-concepts');

        $this->forceClose()->closeModal();
    }
    
    public static function dispatchCloseEvent(): bool
    {
        return true;
    }
}
