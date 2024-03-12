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
        Schema::create('autodoc_leads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email');
            $table->string('ip_address');
            $table->string('zip_path')->nullable();
            $table->string('framework')->nullable();
            $table->mediumText('first_file')->nullable();
            $table->mediumText('first_file_completion')->nullable();
            $table->unsignedInteger('number_of_files')->nullable();
            $table->string('status')->default('pending');
            $table->string('stripe_session_id')->nullable()->index();
            $table->foreignUuid('branch_id')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autodoc_leads');
    }
};
