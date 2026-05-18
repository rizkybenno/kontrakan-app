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
        Schema::create('kamars', function (Blueprint $table) {

            $table->id();

            // relasi ke kontrakan
            $table->foreignId('kontrakan_id')
                  ->constrained()
                  ->onDelete('cascade');

            // nama kamar
            $table->string('nama_kamar');

            // harga per kamar
            $table->bigInteger('harga');

            // status kamar
            $table->enum('status', [
                'tersedia',
                'dibooking',
                'terisi'
            ])->default('tersedia');

            // optional
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};