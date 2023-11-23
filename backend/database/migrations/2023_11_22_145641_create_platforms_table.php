<?php

use App\Models\Team;
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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();
            $table->string('logo_path')->nullable();
            $table->string('domain')->unique();
            $table->string('temporary_domain')->nullable();
            $table->boolean('dns_verified')->default(false);
            $table->boolean('is_public')->default(false);
            $table->string('primary_color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
