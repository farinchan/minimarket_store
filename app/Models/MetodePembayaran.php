<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayaran';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'metode_pembayaran_id', 'id');
    }


}
