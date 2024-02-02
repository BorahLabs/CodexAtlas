<?php

namespace App\Models;

use App\SourceCode\DTO\File;
use Borah\KnowledgeBase\DTO\KnowledgeEmbeddingText;
use Borah\KnowledgeBase\Traits\BelongsToKnowledgeBase;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchDocument extends Model
{
    use BelongsToKnowledgeBase;
    use HasFactory;
    use HasUuids;

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function getEmbeddingsTexts(): KnowledgeEmbeddingText|array
    {
        $embeddings = [
            new KnowledgeEmbeddingText(
                text: $this->content,
                entity: class_basename($this),
            ),
        ];

        return $embeddings;
    }

    public function formatToFile(): File
    {
        return new File(name: $this->name, path: $this->path, sha: '',downloadUrl: '', contents: $this->content);
    }
}
