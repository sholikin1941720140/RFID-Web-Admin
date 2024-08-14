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
        Schema::create('absensi_dosens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('jadwal_mengajar_id');
            $table->boolean('status')->default(false);
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jadwal_mengajar_id')->references('id')->on('jadwal_mengajars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_dosens');
    }
};
