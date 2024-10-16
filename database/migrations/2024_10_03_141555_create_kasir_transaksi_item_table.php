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
        Schema::create('kasir_transaksi_item', function (Blueprint $table) {
            $table->id('id_kasir_transaksi_item');
            $table->unsignedBigInteger('kasir_transaksi_id');
            $table->foreign('kasir_transaksi_id')->references('id_kasir_transaksi')->on('kasir_transaksi')->onDelete('cascade');
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id_produk')->on('produk')->onDelete('cascade');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasir_transaksi_item');
    }
};
