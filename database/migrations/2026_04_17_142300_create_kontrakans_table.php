<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontrakans', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->text('alamat'); // ubah ke TEXT biar muat alamat panjang
            $table->string('wilayah'); // ✅ kecamatan + kota
            $table->integer('harga');
            $table->text('fotos')->nullable(); // simpan JSON array

            $table->integer('jumlah_kamar')->nullable();
            $table->text('fasilitas')->nullable();
            $table->text('deskripsi')->nullable();

            $table->enum('status', ['tersedia', 'tidak'])->default('tersedia');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontrakans');
    }
};