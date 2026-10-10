<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    protected $table = 'halaman';

    protected $fillable = ['slug', 'judul', 'isi'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
