<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Captura extends Model
{
    use HasFactory;

    public function exame()
    {
        return $this->belongsTo(Exame::class);
    }
}
