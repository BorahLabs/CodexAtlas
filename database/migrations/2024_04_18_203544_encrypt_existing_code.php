<?php

use App\Models\SystemComponent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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
                    DB::table('system_components')
                        ->where('id', $systemComponent->id)
                        ->update([
                            'file_contents' => Crypt::encryptString($systemComponent->getRawOriginal('file_contents')),
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
