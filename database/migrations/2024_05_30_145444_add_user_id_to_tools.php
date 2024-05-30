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
        Schema::table('code_convertions', function (Blueprint $table) {
            $table->foreignUuid('user_id')->nullable()->index();
        });

        Schema::table('code_fixings', function (Blueprint $table) {
            $table->foreignUuid('user_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('code_convertions', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('code_fixings', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
