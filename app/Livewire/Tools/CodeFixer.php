<?php

namespace App\Livewire\Tools;

use App\Actions\Autodoc\ProcessAutodocSystemComponent;
use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Atlas\Guesser;
use App\Atlas\Languages\Contracts\Language;
use App\Enums\SystemComponentStatus;
use App\LLM\Contracts\Llm;
use App\LLM\PromptRequests\OpenAI\CodeFixerPromptRequest;
use App\Models\CodeFixing;
use App\Models\SystemComponent;
use App\Models\Tool;
use App\SourceCode\DTO\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CodeFixer extends Component
{
    use WithFileUploads;

    public $solution;

    public $code;

    public $codeError;

    #[Locked]
    public string $ip;

    public function rules()
    {
        return [
            'code' => 'required',
            'codeError' => 'required',
        ];
    }

    public function mount()
    {
        $this->ip = request()->ip();
    }


    private function userExceedsLimitsOfRequests(): bool
    {
        $tool = Tool::codeFixer();

        $codeFixings = $tool->todayIpCodeFixingRequests($this->ip);

        if($codeFixings->count() >= 10){
            $this->solution = null;

            return true;
        } else{
            CodeFixing::create([
                'tool_id' => $tool->id,
                'ip' => $this->ip,
                'code' => $this->code,
                'code_error' => $this->codeError,
                'response' => $this->solution,
            ]);
            return false;
        }
    }

    public function sendCode()
    {
        $this->validate();

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

        $this->solution = (string) json_decode($completion->completion, true)['response'];

        // if ($this->userExceedsLimitsOfRequests()) {
        //     $this->addError('limit', 'You have exceeded the limit of requests. Please, try again tomorrow or sign up.');

        //     return;
        // }

        $tool = Tool::codeFixer();

        // LogUserPerformedAction::dispatch(
        //     \App\Enums\Platform::Codex,
        //     \App\Enums\NotificationType::Success,
        //     'User used tool '. $tool->name,
        //     [],
        // );


    }

    public function render()
    {
        return view('livewire.tools.code-fixer');
    }


}
