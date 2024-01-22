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

    public ?string $question = '';

    public string $title = '';

    public string $content = '';

    public function mount(): void
    {
        $this->fillForm();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.alexandria.page-setup');
    }

    public function submitQuestion(): void
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

    public function submit(): \Livewire\Features\SupportRedirects\Redirector|\Illuminate\Http\RedirectResponse
    {
        $this->validate([
            'title' => 'required|string|max:512',
            'content' => 'required|string',
        ]);

        $guide = $this->upsertCustomGuide();

        return redirect()->route('docs.guides.show', [
            'project' => $this->branch->repository->project,
            'repository' => $this->branch->repository,
            'branch' => $this->branch,
            'customGuide' => $guide,
        ]);
    }

    #[Computed]
    public function isEditing(): bool
    {
        return ! is_null($this->customGuide);
    }

    protected function fillForm(): void
    {
        if (! $this->customGuide) {
            return;
        }

        $this->question = $this->customGuide->question;
        $this->title = $this->customGuide->title;
        $this->content = $this->customGuide->content;
    }

    protected function upsertCustomGuide(): CustomGuide
    {
        if ($this->customGuide) {
            $this->customGuide->update([
                'question' => $this->questionDriven ? $this->question : null,
                'title' => $this->title,
                'content' => $this->content,
            ]);

            return $this->customGuide;
        }

        return $this->branch->customGuides()->create([
            'question' => $this->questionDriven ? $this->question : null,
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }
}
