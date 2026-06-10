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
        Schema::create('group_targets', function (Blueprint $table) {
            $table->id();
            $table->string('group_name')->nullable();
            $table->tinyInteger('age_min')->nullable();
            $table->tinyInteger('age_max')->nullable();
            $table->bigInteger('water')->default(0);
            $table->bigInteger('energy')->default(0);
            $table->bigInteger('protein')->default(0);
            $table->bigInteger('fat')->default(0);
            $table->bigInteger('carbohydrates')->default(0);
            $table->bigInteger('fiber')->default(0);
            $table->bigInteger('ash')->default(0);
            $table->bigInteger('calcium')->default(0);
            $table->bigInteger('phosphorus')->default(0);
            $table->bigInteger('iron')->default(0);
            $table->bigInteger('sodium')->default(0);
            $table->bigInteger('potassium')->default(0);
            $table->bigInteger('copper')->default(0);
            $table->bigInteger('zinc')->default(0);
            $table->bigInteger('retinol')->default(0);
            $table->bigInteger('beta_carotene')->default(0);
            $table->bigInteger('total_carotene')->default(0);
            $table->bigInteger('thiamin')->default(0);
            $table->bigInteger('riboflavin')->default(0);
            $table->bigInteger('niacin')->default(0);
            $table->bigInteger('vitamin_c')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_targets');
    }
};
