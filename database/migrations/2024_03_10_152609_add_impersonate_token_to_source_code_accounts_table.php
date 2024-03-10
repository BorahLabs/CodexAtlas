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
            $table->string('impersonate_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('source_code_accounts', function (Blueprint $table) {
            $table->dropColumn('impersonate_token');
        });
    }
};
