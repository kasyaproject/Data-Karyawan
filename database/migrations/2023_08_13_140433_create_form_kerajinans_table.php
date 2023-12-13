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
        Schema::create('form_kerajinans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_penilaian');
            $table->string('nik_karyawan');
            $table->string('nama_penilai');
            $table->integer('sakit');
            $table->integer('izin');
            $table->integer('tanpaizin');
            $table->integer('terlambat');
            $table->integer('pulangcepat');
            $table->integer('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kerajinans');
    }
};
