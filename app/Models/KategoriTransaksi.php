<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriTransaksi extends Model
{
    protected $table = 'kategori_transaksi';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;
    protected $fillable = [
    'nama_kategori',
    'jenis',
    ];
}
