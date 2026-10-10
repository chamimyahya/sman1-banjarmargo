<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    protected $fillable = ['tanggal', 'judul', 'tempat'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }
}
