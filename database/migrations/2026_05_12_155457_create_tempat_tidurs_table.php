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
        Schema::create('new_tt', function (Blueprint $table) {
            $table->id();
            $table->string('kodekelas');
            $table->string('kelas');
            $table->string('ruang');
            $table->string('kode_ruang');
            $table->integer('tersedia');
            $table->integer('kapasitas');
            $table->integer('tersediawanita');
            $table->integer('tersediapria');
            $table->integer('tersediapriawanita');
            $table->timestamp('ts')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_tt');
    }
};
