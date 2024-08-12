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
        Schema::create('jadwal_mengajar_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_mengajar_id');
            $table->unsignedBigInteger('jam_id');
            $table->timestamps();

            $table->foreign('jadwal_mengajar_id')->references('id')->on('jadwal_mengajars')->onDelete('cascade');
            $table->foreign('jam_id')->references('id')->on('jams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_mengajar_items');
    }
};
