<?php

namespace App\Models;

use App\LLM\DTO\CompletionResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingLogEntry extends Model
{
    use HasFactory;

    public static function write(Branch $branch, string $filePath, string $llmProvider, string $llmModel, CompletionResponse $response)
    {
        static::query()->create([
            'team_id' => $branch->repository->project->team->id,
            'branch_id' => $branch->id,
            'file_path' => $filePath,
            'llm_provider' => $llmProvider,
            'llm_model' => $llmModel,
            'processing_time_milliseconds' => $response->processingTimeMilliseconds,
            'input_tokens' => $response->inputTokens,
            'output_tokens' => $response->outputTokens,
            'total_tokens' => $response->totalTokens,
        ]);
    }
}
