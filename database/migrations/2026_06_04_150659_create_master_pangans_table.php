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
        Schema::create('master_pangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sheet_row_id')->nullable();
            $table->string('nama_id')->nullable();
            $table->string('nama_en')->nullable();
            $table->string('kategori_id')->nullable();
            $table->string('kategori_en')->nullable();
            $table->decimal('kalori', 8, 2)->nullable();
            $table->decimal('protein', 8, 2)->nullable();
            $table->decimal('karbohidrat', 8, 2)->nullable();
            $table->decimal('lemak', 8, 2)->nullable();
            $table->decimal('serat', 8, 2)->nullable();
            $table->decimal('natrium', 8, 2)->nullable();
            $table->decimal('kalsium', 8, 2)->nullable();
            $table->string('source')->nullable();
            $table->decimal('besi', 8, 2)->nullable();
            $table->decimal('fosfor', 8, 2)->nullable();
            $table->decimal('basis_gram', 8, 2)->nullable();
            $table->decimal('abu', 8, 2)->nullable();
            $table->decimal('kalium', 8, 2)->nullable();
            $table->decimal('tembaga', 8, 2)->nullable();
            $table->decimal('seng', 8, 2)->nullable();
            $table->decimal('retinol', 8, 2)->nullable();
            $table->decimal('beta_karoten', 8, 2)->nullable();
            $table->decimal('karoten_total', 8, 2)->nullable();
            $table->decimal('thiamin', 8, 2)->nullable();
            $table->decimal('riboflavin', 8, 2)->nullable();
            $table->decimal('niasin', 8, 2)->nullable();
            $table->decimal('vitamin_c', 8, 2)->nullable();
            $table->decimal('air', 8, 2)->nullable();
            $table->decimal('bdd_percent', 8, 2)->nullable();
            $table->string('scope')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_pangans');
    }
};
