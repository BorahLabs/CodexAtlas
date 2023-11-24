<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('source_code_account_id')->constrained();
            $table->foreignUuid('project_id')->constrained();
            $table->string('username');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['source_code_account_id', 'username', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositories');
    }
};
