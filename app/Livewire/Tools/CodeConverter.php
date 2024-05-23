<?php

namespace App\Livewire\Tools;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\CodeConverter\Tools\CodeConverterTool;
use App\Exceptions\RateLimitExceeded;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Symfony\Contracts\Service\Attribute\Required;

class CodeConverter extends Component
{
    #[Locked]
    public string $from;

    #[Locked]
    public string $to;

    #[Required]
    public ?string $code = null;

    public ?string $result = null;

    public function render()
    {
        return view('livewire.tools.code-converter');
    }

    public function convert()
    {
        $this->resetErrorBag();
        $this->result = null;
        $this->validate([
            'code' => 'required|string|max:800|min:10',
        ]);

        try {
            $tool = CodeConverterTool::from($this->from, $this->to);
            $result = $tool->convert(request()->ip(), $this->code);
        } catch (RateLimitExceeded $e) {
            $this->addError('code', $e->getMessage());
            return;
        }

        LogUserPerformedAction::dispatch(
            \App\Enums\Platform::Codex,
            \App\Enums\NotificationType::Success,
            'User used Code Converter tool',
            [
                'from' => $this->from,
                'to' => $this->to,
            ],
        );
        $this->result = $result;
    }
}
