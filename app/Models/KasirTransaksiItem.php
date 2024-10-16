<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirTransaksiItem extends Model
{
    use HasFactory;

    protected $table = 'kasir_transaksi_item';
    protected $primaryKey = 'id_transaksi_item';
    protected $guarded = [];

    public function kasir_transaksi()
    {
        return $this->belongsTo(KasirTransaksi::class, 'id_transaksi');
    }
}
