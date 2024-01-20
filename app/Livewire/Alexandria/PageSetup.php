<?php

namespace App\Livewire\Alexandria;

use App\Actions\Codex\Alexandria\GenerateAnswer;
use App\Models\Branch;
use Livewire\Attributes\Locked;
use Livewire\Component;

class PageSetup extends Component
{
    #[Locked]
    public Branch $branch;

    public bool $questionDriven = true;
    public string $question = '';
    public string $title = '';
    public string $content = '';

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

        $guide = $this->branch->customGuides()->create([
            'question' => $this->questionDriven ? $this->question : null,
            'title' => $this->title,
            'content' => $this->content,
        ]);

        return redirect()->route('docs.guides.show', [
            'project' => $this->branch->repository->project,
            'repository' => $this->branch->repository,
            'branch' => $this->branch,
            'customGuide' => $guide,
        ]);
    }
}
