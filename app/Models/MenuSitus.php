<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSitus extends Model
{
    protected $table = 'menu_situs';

    protected $fillable = ['label', 'tautan', 'urutan', 'aktif'];

    protected function casts(): array
    {
        return ['aktif' => 'boolean'];
    }
}
