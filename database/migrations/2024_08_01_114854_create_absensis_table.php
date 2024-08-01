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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_mahasiswa_id');
            $table->unsignedBigInteger('user_id');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('jadwal_mahasiswa_id')->references('id')->on('jadwal_mahasiswas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
