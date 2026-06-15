<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranIuran extends Model
{
    protected $table = 'pembayaran_iuran';

    protected $primaryKey = 'id_pembayaran';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(
            AkunUser::class,
            'id_user',
            'id_user'
        );
    }

    public function jenisIuran()
    {
        return $this->belongsTo(
            JenisIuran::class,
            'id_iuran',
            'id_iuran'
        );
    }

    public function periode()
    {
        return $this->belongsTo(
            Periode::class,
            'id_periode',
            'id_periode'
        );
    }
}