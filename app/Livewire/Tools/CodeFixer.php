<?php

namespace App\Livewire\Tools;

use App\Actions\Autodoc\ProcessAutodocSystemComponent;
use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Atlas\Guesser;
use App\Atlas\Languages\Contracts\Language;
use App\Enums\SystemComponentStatus;
use App\LLM\Contracts\Llm;
use App\LLM\PromptRequests\OpenAI\CodeFixerPromptRequest;
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

    public function mount()
    {
        $this->ip = request()->ip();
    }

    public function userExceedsLimitsOfRequests(): bool
    {
        if(Cache::get('code-fixer:next-user-request:'.$this->ip) && Cache::get('code-fixer:next-user-request:'.$this->ip) < Carbon::now()->subDay()){
            Cache::put('code-fixer:user-requests:'.$this->ip, 0);
        }
        return Cache::get('code-fixer:user-requests:'.$this->ip, 0) >= 10;
    }

    public function sendCode()
    {
        if ($this->userExceedsLimitsOfRequests()) {
            Cache::put('code-fixer:next-user-request:'.$this->ip, Carbon::now()->addDay());
            $this->addError('limit', 'You have exceeded the limit of requests. Please, try again later or sign up.');

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

        Cache::increment('code-fixer:user-requests:'.$this->ip);

        $this->solution = json_decode($completion->completion, true)['response'];
    }

    public function render()
    {
        return view('livewire.tools.code-fixer');
    }

}
