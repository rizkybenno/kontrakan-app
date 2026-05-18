<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->bigInteger('jumlah');

            $table->enum('metode', ['transfer', 'qris', 'tunai']);

            $table->string('bukti')->nullable();

            // ⚠️ IMPORTANT: samakan dengan controller
            $table->enum('status', ['menunggu', 'dikonfirmasi'])
                  ->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};