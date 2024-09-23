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
        Schema::create('detail_penilaians', function (Blueprint $table) {
            $table->id('id_detail');
            $table->integer('sakit');
            $table->integer('izin');
            $table->integer('tanpa_izin');
            $table->integer('terlambat');
            $table->integer('pulang_cepat');
            $table->integer('hasil_absensi');
            $table->integer('produktifitas');
            $table->integer('cust_relation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penilaians');
    }
};
