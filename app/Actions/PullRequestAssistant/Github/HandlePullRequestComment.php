<?php

namespace App\Actions\PullRequestAssistant\Github;

use Exception;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class HandlePullRequestComment
{
    use AsAction;

    public const COMMIT_MESSAGE = 'Codex - PR Assitant commit';

    public function handle(Request $request): bool
    {
        if($request->get('action') !== 'created') {
            return false;
        }

        if(!str($request->input('comment.body'))->startsWith('/codex')) {
            return false;
        }

        $commentContent = str($request->input('comment.body'))->after('/codex ');
        [$repositoryOwner, $repository, $branch, $filePath, $startLine, $endLine] = $this->getRepositoryInformation($request);

        $fileLines = GetOriginalFileFromRepository::run($repositoryOwner, $repository, $branch, $filePath);
        $requestChangedFileLines = $this->adaptFileLinesToLLMRequest($fileLines, $startLine, $endLine);
        $formattedLLMResponse = SendRequestToLLM::run($requestChangedFileLines, $commentContent);

        if ($formattedLLMResponse === null || $formattedLLMResponse === []) {
            return false;
        }

        $newFile = $this->generateNewFileWithLLMResponse($fileLines, $startLine, $endLine, $formattedLLMResponse);

        PushNewFileToGithub::run($repository, $branch, $filePath, $repositoryOwner, $newFile, self::COMMIT_MESSAGE);

        return true;
    }

    private function getRepositoryInformation(Request $request): array
    {
        return [
            $request->input('repository.owner.login'),
            $request->input('repository.name'),
            $request->input('pull_request.head.ref'),
            $request->input('comment.path'),
            $request->input('comment.start_line'),
            $request->input('comment.line'),
        ];
    }



    private function adaptFileLinesToLLMRequest(array $fileLines, ?int $startLine, ?int $endLine)
    {
        if($startLine) {
            array_splice($fileLines, $endLine - 1, 0);

            $originalFileFormatted = [];
            foreach ($fileLines as $line => $content) {
                if ($line >= ($startLine - 1) && $line <= ($endLine - 1)) {
                    $originalFileFormatted[] = $content;
                }
            }
            return json_encode($originalFileFormatted);
        }

        //todo: change when no start line
        throw new Exception('You should add lines intervals', 404);
    }

    private function generateNewFileWithLLMResponse($fileLines, $startLine, $endLine, $formattedLLMResponse)
    {
        array_splice($fileLines, $startLine - 1, $endLine - $startLine + 1, $formattedLLMResponse);
        return implode($fileLines);
    }
}
