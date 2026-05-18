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
        Schema::table('kontrakans', function (Blueprint $table) {

            // tambah kolom fotos JSON
            if (!Schema::hasColumn('kontrakans', 'fotos')) {

                $table->json('fotos')
                      ->nullable()
                      ->after('deskripsi');

            }

            // tambah status pengajuan
            if (!Schema::hasColumn('kontrakans', 'status_pengajuan')) {

                $table->string('status_pengajuan')
                      ->default('disetujui')
                      ->after('fotos');

            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontrakans', function (Blueprint $table) {

            if (Schema::hasColumn('kontrakans', 'fotos')) {
                $table->dropColumn('fotos');
            }

            if (Schema::hasColumn('kontrakans', 'status_pengajuan')) {
                $table->dropColumn('status_pengajuan');
            }

        });
    }
};