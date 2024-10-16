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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id('id_pemesanan');
            $table->unsignedBigInteger('pembeli_id');
            $table->foreign('pembeli_id')->references('id_pembeli')->on('pembeli')->onDelete('cascade');
            $table->integer('total_harga_produk');
            $table->string('pengiriman_provinsi');
            $table->string('pengiriman_kota');
            $table->string('pengiriman_alamat');
            $table->string('pengiriman_kurir');
            $table->integer('pengiriman_ongkir');
            $table->integer('total_harga');
            $table->enum('status', ['belum bayar', 'sudah bayar', 'sedang diproses', 'dikirim', 'selesai']);
            $table->string('resi_pengiriman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
