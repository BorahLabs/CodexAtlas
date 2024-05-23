<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Contracts\Framework;
use App\Atlas\Languages\Contracts\Language;
use App\Exceptions\RateLimitExceeded;
use App\LLM\Contracts\Llm;
use App\Models\CodeConvertion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
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
        return $this->from->name().' to '.$this->to->name() . ' Code Converter';
    }

    public function url(bool $absolute = true): string
    {
        return route('tools.code-converter', ['from' => str($this->from->name())->slug(), 'to' => str($this->to->name())->slug()], absolute: $absolute);
    }

    public function promptInjection(): ?string
    {
        return null;
    }

    public function convert(string $ipAddress, string $code): string
    {
        $usage = CodeConvertion::query()
            ->where('ip', $ipAddress)
            ->where('created_at', '>=', today())
            ->count();
        throw_if($usage >= 5, new RateLimitExceeded('You have reached the maximum number of conversions (5) for today. Please, try again tomorrow.'));

        $code = substr($code, 0, 800);
        $systemPrompt = 'Act as if you were an experienced software developer skilled in multiple programming languages and frameworks.

Convert the following piece of code from '.$this->from->name().' to '.$this->to->name().' to ensure functionality and efficiency are maintained.';

        $userPrompt = 'Input in '.$this->from->name().': ```
'.$code.'
```

Output in '.$this->to->name().': ```';

        /**
         * @var Llm $llm
         */
        $llm = app(Llm::class);
        $result = $llm->completion($systemPrompt, $userPrompt);
        if (substr_count($result->completion, '```') >= 2) {
            $result = str($result->completion)->after('```')->beforeLast('```')->trim();
        } else {
            $result = str($result->completion)->beforeLast('```')->trim();
        }

        CodeConvertion::query()->create([
            'from' => $this->from->name(),
            'to' => $this->to->name(),
            'ip' => $ipAddress,
        ]);

        return $result;
    }

    public static function from(string $from, string $to): static
    {
        $tool = collect(File::allFiles(app_path('CodeConverter/Tools')))
            ->map(fn (SplFileInfo $file) => 'App\\CodeConverter\\Tools\\'.$file->getBasename('.php'))
            ->filter(fn (string $class) => class_exists($class) && is_subclass_of($class, self::class))
            ->map(fn (string $class) => new $class())
            ->filter(fn (CodeConverterTool $tool) => str($tool->from->name())->slug()->is($from) && str($tool->to->name())->slug()->is($to))
            ->values()
            ->first();

        abort_unless($tool, 404, 'No tool found.');

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
