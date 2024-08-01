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
        Schema::create('jadwal_mengajars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('mata_kuliah_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->string('hari');
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('mata_kuliah_id')->references('id')->on('mata_kuliahs')->onDelete('cascade');
            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_mengajar');
    }
};
