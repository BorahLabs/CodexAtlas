<?php

namespace App\Livewire\Tools;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Models\UserFeedback as ModelsUserFeedback;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UserFeedback extends Component
{
    #[Locked]
    public Model $model;

    #[Locked]
    public string $url;

    public function mount()
    {
        $this->url = request()->url();
    }

    public function render()
    {
        return view('livewire.tools.user-feedback');
    }

    #[Computed]
    public function feedback(): ?ModelsUserFeedback
    {
        return $this->model->feedback;
    }

    public function setHelpful(bool $isHelpful)
    {
        $this->model->feedback()->updateOrCreate(
            [],
            ['is_helpful' => $isHelpful, 'user_id' => auth()->id(), 'url' => $this->url],
        );
        LogUserPerformedAction::dispatch(
            \App\Enums\Platform::Codex,
            \App\Enums\NotificationType::Info,
            $isHelpful ? 'User considered output helpful' : 'User did not consider output helpful',
            [
                'model' => class_basename($this->model),
                'id' => $this->model->id,
                'feedback_id' => $this->model->feedback->id,
                'url' => $this->url,
            ]
        );
    }
}
