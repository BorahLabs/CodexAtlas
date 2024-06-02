<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Contracts\Framework;
use App\Atlas\Languages\Contracts\Language;
use App\Enums\SubscriptionType;
use App\Exceptions\RateLimitExceeded;
use App\LLM\Contracts\Llm;
use App\Models\CodeConverterContent;
use App\Models\CodeConvertion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;

abstract class CodeConverterTool
{
    public function __construct(
        public readonly Framework|Language $from,
        public readonly Framework|Language $to,
    ) {
        //
    }

    public function name(): string
    {
        return $this->from->name().' to '.$this->to->name().' Code Converter';
    }

    public function url(bool $absolute = true): string
    {
        return route('tools.code-converter', ['from' => str($this->from->name())->slug(), 'to' => str($this->to->name())->slug()], absolute: $absolute);
    }

    public function promptInjection(): ?string
    {
        return null;
    }

    /**
     * @return array[CodeConvertion, string]
     */
    public function convert(string $ipAddress, string $code, bool $isRunFromPlatform = false): array
    {
        if ($isRunFromPlatform) {
            $usage = CodeConvertion::query()
                ->where('user_id', auth()->id())
                ->where('created_at', '>=', today())
                ->count();
            /**
             * @var SubscriptionType $subscriptionType
             */
            $subscriptionType = auth()->user()?->currentTeam?->subscriptionType() ?? SubscriptionType::FreeTrial;
            throw_if($usage >= $subscriptionType->maxCodeConversions(), new RateLimitExceeded('You have reached the maximum number of conversions ('.$subscriptionType->maxCodeConversions().') for today. Please, try again tomorrow or sign up for a paid plan.'));
        } else {
            $usage = CodeConvertion::query()
                ->where('ip', $ipAddress)
                ->where('created_at', '>=', today())
                ->count();
            throw_if($usage >= 5, new RateLimitExceeded('You have reached the maximum number of conversions (5) for today. Please, try again tomorrow or sign up for a paid plan.'));
        }

        $code = substr($code, 0, 2000);
        $systemPrompt = 'Act as if you were an experienced software developer skilled in multiple programming languages and frameworks. Return the response in Markdown format. Do not try to explain, just return the code.

Convert the following piece of code from '.$this->from->name().' to '.$this->to->name().' to ensure functionality and efficiency are maintained.';

        $userPrompt = 'Input in '.$this->from->name().': ```
'.$code.'
```

Output in '.$this->to->name().':';

        /**
         * @var Llm $llm
         */
        $llm = app(Llm::class);
        $result = $llm->completion($systemPrompt, $userPrompt);

        $convertion = CodeConvertion::query()->create([
            'from' => $this->from->name(),
            'to' => $this->to->name(),
            'ip' => $ipAddress,
            'user_id' => auth()->id(),
        ]);

        return [$convertion, $result->completion];
    }

    public function content(): ?CodeConverterContent
    {
        return CodeConverterContent::query()
            ->where('from', Str::slug($this->from->name()))
            ->where('to', Str::slug($this->to->name()))
            ->first();
    }

    public static function from(string $from, string $to): CodeConverterTool
    {
        /**
         * @var CodeConverterTool|null $tool
         */
        $tool = collect(File::allFiles(app_path('CodeConverter/Tools')))
            ->map(fn (SplFileInfo $file) => 'App\\CodeConverter\\Tools\\'.$file->getBasename('.php'))
            ->filter(fn (string $class) => class_exists($class) && is_subclass_of($class, self::class))
            ->map(fn (string $class) => new $class())
            ->filter(fn (CodeConverterTool $tool) => str($tool->from->name())->slug()->is($from) && str($tool->to->name())->slug()->is($to))
            ->values()
            ->first();

        abort_if(is_null($tool), 404, 'No tool found.');

        return $tool;
    }

    /**
     * Get all tools.
     *
     * @return Collection<CodeConverterTool>
     */
    public static function all(): Collection
    {
        $tools = collect(File::allFiles(app_path('CodeConverter/Tools')))
            ->map(fn (SplFileInfo $file) => 'App\\CodeConverter\\Tools\\'.$file->getBasename('.php'))
            ->filter(fn (string $class) => class_exists($class) && is_subclass_of($class, self::class))
            ->map(fn (string $class) => new $class())
            ->values();

        return $tools;
    }
}
