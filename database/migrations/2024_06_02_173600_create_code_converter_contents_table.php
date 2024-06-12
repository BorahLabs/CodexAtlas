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
        Schema::create('code_converter_contents', function (Blueprint $table) {
            $table->id();
            $table->string('from', 50);
            $table->string('to', 50);
            $table->mediumText('markdown_content');
            $table->timestamps();

            $table->unique(['from', 'to']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_converter_contents');
    }
};
