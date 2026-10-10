<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';

    protected $fillable = ['nama', 'kontak', 'isi', 'dibaca_pada', 'balasan', 'diarsipkan'];

    protected function casts(): array
    {
        return [
            'dibaca_pada' => 'datetime',
            'diarsipkan' => 'boolean',
        ];
    }
}
