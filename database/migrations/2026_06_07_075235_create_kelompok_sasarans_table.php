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
        Schema::create('kelompok_sasaran', function (Blueprint $table) {
            $table->id();
            $table->string('group_name')->nullable();
            $table->tinyInteger('age_min')->nullable();
            $table->tinyInteger('age_max')->nullable();
            $table->bigInteger('')->default(0);
            $table->bigInteger('')->default(0);
            $table->bigInteger('')->default(0);
            $table->bigInteger('')->default(0);
            $table->bigInteger('')->default(0);
            $table->bigInteger('')->default(0);
            $table->bigInteger('')->default(0);
            $table->bigInteger('')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_sasaran');
    }
};
