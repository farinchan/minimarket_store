<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirTransaksi extends Model
{
    use HasFactory;

    protected $table = 'kasir_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $guarded = [];

    public function kasirTransaksiItem()
    {
        return $this->hasMany(KasirTransaksiItem::class, 'kasir_transaksi_id', 'id_kasir_transaksi');
    }

}
