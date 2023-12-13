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
        Schema::create('form_penilaians', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_penilaian');
            $table->string('nik_karyawan');
            $table->string('nama_penilai');
            $table->integer('kerajinan');
            $table->integer('loyalitas');
            $table->integer('inisiatif');
            $table->integer('kerjasama');
            $table->integer('integritas');
            $table->integer('daqumethod');
            $table->integer('custrelation');
            $table->integer('kerapihan');
            $table->string('verifikasi');
            $table->integer('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_penilaians');
    }
};
