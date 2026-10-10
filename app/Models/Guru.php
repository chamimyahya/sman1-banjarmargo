<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = ['nama', 'jabatan', 'tugas', 'mapel', 'foto', 'aktif'];

    protected function casts(): array
    {
        return ['aktif' => 'boolean'];
    }
}
