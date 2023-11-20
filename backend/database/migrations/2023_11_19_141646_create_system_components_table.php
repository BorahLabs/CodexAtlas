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
        Schema::create('system_components', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('branch_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('order')->index();
            $table->string('path', 1024);
            $table->string('sha')->unique();
            $table->mediumText('file_contents')->nullable();
            $table->mediumText('markdown_docs')->nullable();
            $table->string('status', 32);
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['branch_id', 'path']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_components');
    }
};
