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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('nm_dokter', 100);
            $table->timestamps();
        });

        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruangan', 100);
            $table->timestamps();
        });

        Schema::create('jadwal_dokters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokter_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('hari_kerja', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->boolean('aktivasi')->default(true);
            $table->timestamps();

            // Simple indexes/foreign keys if needed, but keeping it simple for now
            $table->foreign('dokter_id')->references('id')->on('dokters')->onDelete('cascade');
            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokters');
        Schema::dropIfExists('ruangans');
        Schema::dropIfExists('dokters');
    }
};
