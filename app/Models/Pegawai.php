<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $guarded = [];

    public function getFoto(){
        return $this->foto ? Storage::url($this->foto) : 'https://ui-avatars.com/api/?background=000C32&color=fff&name='.urlencode($this->nama);
    }
}
