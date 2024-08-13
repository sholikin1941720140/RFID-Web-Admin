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
        Schema::create('jadwal_mahasiswa_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_mahasiswa_id');
            $table->unsignedBigInteger('jadwal_mengajar_id');
            $table->timestamps();

            $table->foreign('jadwal_mahasiswa_id')->references('id')->on('jadwal_mahasiswas')->onDelete('cascade');
            $table->foreign('jadwal_mengajar_id')->references('id')->on('jadwal_mengajars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_mahasiswa_items');
    }
};
