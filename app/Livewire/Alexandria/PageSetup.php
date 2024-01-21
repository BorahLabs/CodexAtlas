<?php

namespace App\Livewire\Alexandria;

use App\Actions\Codex\Alexandria\GenerateAnswer;
use App\Models\Branch;
use App\Models\CustomGuide;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class PageSetup extends Component
{
    #[Locked]
    public Branch $branch;

    #[Locked]
    public ?CustomGuide $customGuide = null;

    public bool $questionDriven = true;
    public string $question = '';
    public string $title = '';
    public string $content = '';

    public function mount()
    {
        if ($this->customGuide) {
            $this->question = $this->customGuide->question;
            $this->title = $this->customGuide->title;
            $this->content = $this->customGuide->content;
        }
    }

    public function render()
    {
        return view('livewire.alexandria.page-setup');
    }

    public function submitQuestion()
    {
        $this->validate([
            'question' => 'required|string|max:512',
        ]);

        $answer = GenerateAnswer::make()->handle($this->question, $this->branch);
        if ($answer) {
            $this->title = $answer->title;
            $this->content = $answer->content;
        }
    }

    public function submit()
    {
        $this->validate([
            'title' => 'required|string|max:512',
            'content' => 'required|string',
        ]);

        $guide = $this->customGuide ?? $this->branch->customGuides()->new();
        $guide->question = $this->questionDriven ? $this->question : null;
        $guide->title = $this->title;
        $guide->content = $this->content;
        $guide->save();

        return redirect()->route('docs.guides.show', [
            'project' => $this->branch->repository->project,
            'repository' => $this->branch->repository,
            'branch' => $this->branch,
            'customGuide' => $guide,
        ]);
    }

    #[Computed]
    public function isEditing()
    {
        return ! is_null($this->customGuide);
    }
}
