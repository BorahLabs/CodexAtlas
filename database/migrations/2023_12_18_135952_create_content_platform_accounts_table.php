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
        Schema::create('content_platform_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_id')->constrained()->cascadeOnDelete();
            $table->string('platform', 32)->index();
            $table->mediumText('access_token')->nullable();
            $table->mediumText('refresh_token')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->string('external_id')->nullable();
            $table->string('domain')->nullable();
            $table->timestamps();

            $table->unique(['team_id', 'platform', 'external_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_platform_accounts');
    }
};
