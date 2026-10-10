<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unduhan extends Model
{
    protected $table = 'unduhan';

    protected $fillable = ['judul', 'berkas'];
}
