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
        Schema::create('form_analises', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_penilaian');
            $table->string('nik_karyawan');
            $table->string('nama_penilai');
            $table->json('kelebihan');    // Kolom tipe json untuk multiple select
            $table->json('kekurangan');    // Kolom tipe json untuk multiple select
            $table->text('rangkuman');
            $table->text('kebutuhan');
            $table->text('rekomendasi');
            $table->text('catatan');        // tambahan untuk catatan akhir setelah diskusi
            $table->integer('hasil_kelebihan');
            $table->integer('hasil_kekurangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_analises');
    }
};
