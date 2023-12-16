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
        Schema::create('processing_log_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('team_id');
            $table->foreignUuid('branch_id');
            $table->string('file_path');
            $table->string('llm_provider');
            $table->string('llm_model');
            $table->unsignedBigInteger('processing_time_milliseconds');
            $table->unsignedBigInteger('input_tokens');
            $table->unsignedBigInteger('output_tokens');
            $table->unsignedBigInteger('total_tokens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processing_log_entries');
    }
};
