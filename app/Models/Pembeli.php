<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pembeli extends Model
{
    use HasFactory;

    protected $table = 'pembeli';
    protected $primaryKey = 'id_pembeli';
    protected $guarded = [];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'pembeli_id', 'id_pembeli');
    }

    public function getFoto(){
        return $this->foto ? Storage::url($this->foto) : 'https://ui-avatars.com/api/?background=000C32&color=fff&name='.$this->nama;
    }
}
