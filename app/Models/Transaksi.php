<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi';

    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(
            KategoriTransaksi::class,
            'id_kategori',
            'id_kategori'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            AkunUser::class,
            'id_user',
            'id_user'
        );
    }

    public function kegiatan()
    {
        return $this->belongsTo(
            KegiatanKelas::class,
            'id_kegiatan',
            'id_kegiatan'
        );
    }
}