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
        Schema::create('kasir_transaksi', function (Blueprint $table) {
            $table->id('id_kasir_transaksi');
            $table->unsignedBigInteger('kasir_id');
            $table->foreign('kasir_id')->references('id_pegawai')->on('pegawai')->onDelete('cascade');
            $table->integer('total_harga');
            $table->integer('bayar');
            $table->integer('kembalian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasir_transaksi');
    }
};
