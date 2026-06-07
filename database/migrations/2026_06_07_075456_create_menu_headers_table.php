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
        Schema::create('menu_header', function (Blueprint $table) {
            $table->id();
            $table->foreign('group_id')->constrained('kelompok_sasaran')->onCascadeDelete();
            $table->bigInteger('target_population')->unsigned()->default(1);
            $table->tinyInteger('total_item')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_header');
    }
};
