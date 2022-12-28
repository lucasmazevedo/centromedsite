<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;


    protected $generos = array(
        '0' => 'Masculino',
        '1' => 'Feminino',
    );

    public function exames()
    {
        return $this->hasMany(Exame::class);
    }

    public function generoPaciente($value)
    {
        return $this->generos[$value];
    }

}
