<?php

namespace App\Actions\Onboarding;

use App\LLM\Contracts\Llm;
use App\LLM\PromptRequests\OpenAI\GenerateProjectDescriptionFromUrlPromptRequest;
use Illuminate\Support\Facades\Http;
use League\CommonMark\CommonMarkConverter;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\Mime\HtmlToTextConverter\LeagueHtmlToMarkdownConverter;

class GenerateProjectDescriptionFromUrl
{
    use AsAction;

    public function handle(string $url)
    {
        $content = Http::timeout(5)
            ->get($url)
            ->throw()
            ->body();
        // Extract content inside the body tag
        preg_match('/<body.*?>(.*?)<\/body>/is', $content, $matches);
        $bodyContent = $matches[1] ?? '';
        abort_if(empty($bodyContent), 404, 'No content found in the provided URL');

        $converter = new LeagueHtmlToMarkdownConverter();
        $content = $converter->convert($bodyContent, 'utf-8');
        $content = substr($content, 0, 2500);

        /**
         * @var Llm $llm
         */
        $llm = app(Llm::class);
        $prompt = new GenerateProjectDescriptionFromUrlPromptRequest();
        $content = $llm->completion(
            systemPrompt: $prompt->systemPrompt([]),
            userPrompt: $prompt->userPrompt(['content' => $content]),
        );

        $content = str($content->completion)
            ->after('<output>')
            ->before('</output>')
            ->trim()
            ->value();
        abort_if(empty($content), 400, 'Invalid response from the AI model');

        return $content;
    }
}
