<?php

use App\Models\SystemComponent;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        SystemComponent::query()
            ->whereNotNull('file_contents')
            ->each(function (SystemComponent $systemComponent) {
                try {
                    if (strlen($systemComponent->file_contents) > 0) {
                        return true;
                    }
                } catch (\Exception $e) {
                    // Encryption error. Code is not encrypted!
                    $systemComponent->update([
                        'file_contents' => $systemComponent->getRawOriginal('file_contents'),
                    ]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
