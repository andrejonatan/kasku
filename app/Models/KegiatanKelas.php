<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanKelas extends Model
{
    protected $table = 'kegiatan_kelas';
    protected $primaryKey = 'id_kegiatan';
    public $timestamps = false;
    protected $guarded = [];
}
