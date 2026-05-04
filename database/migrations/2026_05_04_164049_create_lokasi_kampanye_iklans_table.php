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
        Schema::create('lokasi_kampanye_iklans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kampanye_iklan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lokasi_id')->constrained()->cascadeOnDelete();

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_kampanye_iklans');
    }
};
