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
        Schema::table('source_code_accounts', function (Blueprint $table) {
            $table->string('webhook_id')->nullable();
            $table->string('webhook_secret')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('source_code_accounts', function (Blueprint $table) {
            $table->dropColumn('webhook_id');
            $table->dropColumn('webhook_secret');
        });
    }
};
