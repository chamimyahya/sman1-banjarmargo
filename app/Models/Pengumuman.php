<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = ['tanggal', 'judul', 'ringkas', 'isi', 'penting', 'tampil_beranda'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'penting' => 'boolean',
            'tampil_beranda' => 'boolean',
        ];
    }
}
