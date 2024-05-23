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
        Schema::create('code_fixings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tool_id');
            $table->foreign('tool_id')->references('id')->on('tools');
            $table->mediumText('code');
            $table->mediumText('code_error');
            $table->mediumText('response');
            $table->string('ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_fixings');
    }
};
