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
            $table->decimal('kalori', 8, 2)->nullable()->default(0);
            $table->decimal('protein', 8, 2)->nullable()->default(0);
            $table->decimal('karbohidrat', 8, 2)->nullable()->default(0);
            $table->decimal('lemak', 8, 2)->nullable()->default(0);
            $table->decimal('serat', 8, 2)->nullable()->default(0);
            $table->decimal('natrium', 8, 2)->nullable()->default(0);
            $table->decimal('kalsium', 8, 2)->nullable()->default(0);
            $table->string('source')->nullable();
            $table->decimal('besi', 8, 2)->nullable()->default(0);
            $table->decimal('fosfor', 8, 2)->nullable()->default(0);
            $table->decimal('basis_gram', 8, 2)->nullable()->default(0);
            $table->decimal('abu', 8, 2)->nullable()->default(0);
            $table->decimal('kalium', 8, 2)->nullable()->default(0);
            $table->decimal('tembaga', 8, 2)->nullable()->default(0);
            $table->decimal('seng', 8, 2)->nullable()->default(0);
            $table->decimal('retinol', 8, 2)->nullable()->default(0);
            $table->decimal('beta_karoten', 8, 2)->nullable()->default(0);
            $table->decimal('karoten_total', 8, 2)->nullable()->default(0);
            $table->decimal('thiamin', 8, 2)->nullable()->default(0);
            $table->decimal('riboflavin', 8, 2)->nullable()->default(0);
            $table->decimal('niasin', 8, 2)->nullable()->default(0);
            $table->decimal('vitamin_c', 8, 2)->nullable()->default(0);
            $table->decimal('air', 8, 2)->nullable()->default(0);
            $table->decimal('bdd_percent', 8, 2)->nullable()->default(0);
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
