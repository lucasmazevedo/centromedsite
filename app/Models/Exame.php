<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    use HasFactory;

    protected $statuses = array(
        '0' => '<span class="badge py-3 px-4 fs-7 badge-light-warning">Captura Pendente</span>',
        '1' => '<span class="badge py-3 px-4 fs-7 badge-light-info">Captura Realizada</span>',
        '2' => '<span class="badge py-3 px-4 fs-7 badge-light-primary">Laudo Digitado</span>',
        '3' => '<span class="badge py-3 px-4 fs-7 badge-light-success">Laudo Assinado</span>',
        '4' => '<span class="badge py-3 px-4 fs-7 badge-light-danger">Exame Cancelado</span>'
    );

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function modalidade()
    {
        return $this->belongsTo(Modalidade::class);
    }

    public function getSituacaoAttribute($value)
    {
        return $this->statuses[$value];
    }

    public function imagens()
    {
        return $this->hasMany(Captura::class);
    }

    public function laudo()
    {
        return $this->hasOne(Laudo::class);
    }

    public function operador()
    {
        return $this->belongsTo(User::class);
    }
}
