<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeConverterContent extends Model
{
    use HasFactory;

    public function parsedContent(): Attribute
    {
        return Attribute::make(
            get: function () {
                $content = $this->markdown_content;
                $lines = array_values(array_filter(explode("\n", $content), fn (string $line) => !empty(trim($line))));
                if (count($lines) < 2) {
                    return $content;
                }

                if (str_starts_with($lines[0], '## ') && str_starts_with($lines[1], '## ')) {
                    // Remove the second line from $content, without modifying the spacing
                    $content = str_replace($lines[1] . "\n", '', $content);
                }

                return $content;
            }
        );
    }
}
