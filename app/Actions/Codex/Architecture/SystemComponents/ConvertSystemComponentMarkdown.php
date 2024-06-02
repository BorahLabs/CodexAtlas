<?php

namespace App\Actions\Codex\Architecture\SystemComponents;

use App\Services\FormatterHelper;
use Lorisleiva\Actions\Concerns\AsAction;

class ConvertSystemComponentMarkdown
{
    use AsAction;

    public function handle(?array $completion, string $path): ?string
    {
        if (! $completion) {
            return null;
        }

        $completion = FormatterHelper::convertArrayKeysToLowerCase($completion);

        $markdown = '# '.basename($path)."\n\n";
        if (isset($completion['tldr'])) {
            $markdown .= '## TLDR'."\n";
            $markdown .= $completion['tldr'];
        }

        if (isset($completion['classes']) && ! empty($completion['classes'])) {
            $markdown .= "\n\n".'## Classes'."\n\n";
            foreach ($completion['classes'] as $class) {
                if (isset($class['name']) && isset($class['description'])) {
                    $markdown .= '### '.$class['name']."\n";
                    $markdown .= $class['description']."\n\n";
                    if (isset($class['methods']) && ! empty($class['methods'])) {
                        foreach ($class['methods'] as $method) {
                            if (isset($method['name']) && isset($method['description'])) {
                                $markdown .= '#### '.$method['name']."\n";
                                $markdown .= $method['description']."\n\n";
                            }
                        }
                    }
                }
            }
        }

        return $markdown;
    }
}
