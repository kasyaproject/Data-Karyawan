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
        Schema::create('hasil_fuzzies', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_penilaian');
            $table->string('nik_karyawan');
            $table->string('nama_penilai');
            $table->string('penilaian_him');
            $table->string('penilaian_a');
            $table->string('kerajinan_him');
            $table->string('kerajinan_a');
            $table->string('kelebihan_him');
            $table->string('kelebihan_a');
            $table->string('kekurangan_him');
            $table->string('kekurangan_a');
            $table->string('output');
            $table->integer('point');
            $table->string('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_fuzzies');
    }
};
