<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisIuran extends Model
{
    protected $table = 'jenis_iuran';
    protected $primaryKey = 'id_iuran';
    public $timestamps = false;
    protected $guarded = [];
}
