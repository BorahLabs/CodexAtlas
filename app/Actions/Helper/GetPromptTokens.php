<?php

namespace App\Actions\Helper;

use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;
use Yethee\Tiktoken\EncoderProvider;

class GetPromptTokens
{
    use AsAction;

    public string $commandSignature = 'helper:get-prompt-tokens {model} {prompt}';


    public function handle(string $model, string $prompt): int
    {
        $provider = new EncoderProvider();
        $encoder = $provider->getForModel($model);
        $tokens = $encoder->encode($prompt);
        return count($tokens);
    }

    // @codeCoverageIgnoreStart
    public function asCommand(Command $command): void
    {
        $model = $command->argument('model');
        $prompt =  $command->argument('prompt');

        $tokensCount = $this->handle($model, $prompt);
        $command->info($tokensCount);
    }
    // @codeCoverageIgnoreEnd
}
