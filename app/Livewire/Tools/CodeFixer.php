<?php

namespace App\Livewire\Tools;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\LLM\Contracts\Llm;
use App\LLM\PromptRequests\OpenAI\CodeFixerPromptRequest;
use App\Models\CodeFixing;
use App\Models\Tool;
use Livewire\Attributes\Locked;
use Livewire\Component;

class CodeFixer extends Component
{
    public string $code;

    public string $codeError;

    #[Locked]
    public string $ip;

    public ?CodeFixing $codeFixing = null;

    public function rules(): array
    {
        return [
            'code' => 'required|string|max:800',
            'codeError' => 'required|string|max:400',
        ];
    }

    public function mount(): void
    {
        $this->ip = request()->ip();
        $this->codeFixing = CodeFixing::first();
    }

    private function userExceedsLimitsOfRequests(): bool
    {
        $tool = Tool::codeFixer();

        $codeFixings = $tool->todayIpCodeFixingRequests($this->ip);

        return $codeFixings->count() >= 5;
    }

    public function sendCode(): void
    {
        $this->resetErrorBag();
        $this->validate();

        if ($this->userExceedsLimitsOfRequests()) {
            $this->codeFixing = null;
            $this->addError('limit', 'You have exceeded the limit of requests. Please, try again tomorrow or sign up for a paid plan.');

            return;
        }

        $data = [
            'code' => $this->code,
            'codeError' => $this->codeError,
        ];

        /**
         * @var Llm
         */
        $llm = app(Llm::class);

        $prompt = new CodeFixerPromptRequest();
        $systemPrompt = $prompt->systemPrompt($data);
        $userPrompt = $prompt->userPrompt($data);
        $completion = $llm->completion($systemPrompt, $userPrompt);

        $solution = json_decode($completion->completion, true)['response'] ?? null;

        $tool = Tool::codeFixer();

        $this->codeFixing = CodeFixing::create([
            'tool_id' => $tool->id,
            'ip' => $this->ip,
            'code' => $this->code,
            'code_error' => $this->codeError,
            'response' => $solution,
        ]);
        LogUserPerformedAction::dispatch(
            \App\Enums\Platform::Codex,
            \App\Enums\NotificationType::Success,
            'User used tool '.$tool->name,
            [
                'id' => $this->codeFixing->id,
            ],
        );

        $this->dispatch('update-code');
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.tools.code-fixer');
    }
}
