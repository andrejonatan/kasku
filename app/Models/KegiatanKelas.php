<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanKelas extends Model
{
    protected $table = 'kegiatan_kelas';
    protected $primaryKey = 'id_kegiatan';
    public $timestamps = false;
    protected $fillable = [
    'nama_kegiatan',
    'deskripsi',
    'tanggal_mulai',
    'tanggal_selesai',
    ];
}
