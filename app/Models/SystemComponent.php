<?php

namespace App\Models;

use App\Enums\SystemComponentStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class SystemComponent extends Model
{
    use Searchable;
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $casts = [
        'status' => SystemComponentStatus::class,
        // 'file_contents' => 'encrypted',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function folder(): Attribute
    {
        return Attribute::make(
            get: fn () => dirname($this->path),
        );
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn () => basename($this->path),
        );
    }

    public function extension(): Attribute
    {
        return Attribute::make(
            get: fn () => pathinfo($this->path, PATHINFO_EXTENSION),
        );
    }

    public function language(): Attribute
    {
        return Attribute::make(
            get: fn () => match (true) {
                str_ends_with($this->path, '.blade.php') => 'blade',
                default => pathinfo($this->path, PATHINFO_EXTENSION),
            }
        );
    }

    public function content(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (is_null($this->file_contents)) {
                    return null;
                }

                return $this->markdown_docs."\n\n```".$this->language."\n".$this->file_contents."\n```";
            },
        );
    }

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'system_component_index_' . $this->branch_id;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {

        return [
            'url' =>  $this->branch->repository->project->team->currentPlatform()
                                ->route('docs.show-component',
                                    [
                                    'project' => $this->branch->repository->project,
                                    'repository' => $this->branch->repository,
                                    'branch' => $this->branch,
                                    'systemComponent' => $this,
                                    ]),
            'title' => basename($this->path),
            'type' => 'lvl1',
            'content' => $this->markdown_docs,
            'hierarchy' => [
                'lvl0' => str($this->path)->beforeLast("/"),
                'lvl1' => basename($this->path),
            ]
        ];
    }
}
