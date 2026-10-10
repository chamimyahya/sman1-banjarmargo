<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    protected $table = 'galeri_foto';

    protected $fillable = ['judul', 'berkas', 'kategori'];
}
