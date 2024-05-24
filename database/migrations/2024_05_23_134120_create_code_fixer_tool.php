<?php

use App\Models\Tool;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Tool::query()->create([
            'name' => 'code-fixer',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Tool::query()->where('name', 'code-fixer')->delete();
    }
};
