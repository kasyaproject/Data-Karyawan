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
        Schema::create('fuzzies', function (Blueprint $table) {
            $table->id('id_fuzzy');
            $table->string('absensi_a');
            $table->string('absensi_him');
            $table->string('produktifitas_a');
            $table->string('produktifitas_him');
            $table->string('custrelation_a');
            $table->string('custrelation_him');
            $table->string('keputusan');
            $table->decimal('probabilitas', 8, 4);
            $table->string('probabilitas_him');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzies');
    }
};
