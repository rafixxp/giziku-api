<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_pangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sheet_row_id')->nullable();
            $table->string('name_id')->nullable();
            $table->string('name_en')->nullable();
            $table->string('category_id')->nullable();
            $table->string('category_en')->nullable();
            $table->decimal('calories', 8, 2)->nullable()->default(0);
            $table->decimal('protein', 8, 2)->nullable()->default(0);
            $table->decimal('carbohydrates', 8, 2)->nullable()->default(0);
            $table->decimal('fat', 8, 2)->nullable()->default(0);
            $table->decimal('fiber', 8, 2)->nullable()->default(0);
            $table->decimal('sodium', 8, 2)->nullable()->default(0);
            $table->decimal('calcium', 8, 2)->nullable()->default(0);
            $table->string('source')->nullable();
            $table->decimal('iron', 8, 2)->nullable()->default(0);
            $table->decimal('phosphorus', 8, 2)->nullable()->default(0);
            $table->decimal('basis_gram', 8, 2)->nullable()->default(0);
            $table->decimal('ash', 8, 2)->nullable()->default(0);
            $table->decimal('potassium', 8, 2)->nullable()->default(0);
            $table->decimal('copper', 8, 2)->nullable()->default(0);
            $table->decimal('zinc', 8, 2)->nullable()->default(0);
            $table->decimal('retinol', 8, 2)->nullable()->default(0);
            $table->decimal('beta_carotene', 8, 2)->nullable()->default(0);
            $table->decimal('total_carotene', 8, 2)->nullable()->default(0);
            $table->decimal('thiamin', 8, 2)->nullable()->default(0);
            $table->decimal('riboflavin', 8, 2)->nullable()->default(0);
            $table->decimal('niacin', 8, 2)->nullable()->default(0);
            $table->decimal('vitamin_c', 8, 2)->nullable()->default(0);
            $table->decimal('water', 8, 2)->nullable()->default(0);
            $table->decimal('bdd_percent', 8, 2)->nullable()->default(0);
            $table->string('scope')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_pangans');
    }
};
