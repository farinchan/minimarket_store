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

    public function kasir_transaksi_item()
    {
        return $this->hasMany(KasirTransaksiItem::class, 'id_transaksi');
    }

}
