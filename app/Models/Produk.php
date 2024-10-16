<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id', 'id_kategori_produk');
    }

    public function getGambar(){
        return $this->gambar ? Storage::url($this->gambar) : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg';
    }
}
