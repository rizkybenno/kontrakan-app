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
        Schema::create('bookings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('kontrakan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('no_hp');

            // 🔥 BOOKING SYSTEM BARU
            $table->integer('lama_sewa');

            // 🔥 METODE PEMBAYARAN
            $table->enum('metode_pembayaran', [
                'bca',
                'bsi',
                'qris'
            ]);

            // 🔥 TOTAL BAYAR
            $table->bigInteger('total_harga');

            // 🔥 STATUS BOOKING
            $table->enum('status', [
                'pending',
                'disetujui',
                'ditolak'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};