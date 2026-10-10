<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = ['tanggal', 'judul', 'ringkas', 'isi'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }
}
