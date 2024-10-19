<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $table = 'veiculos';
    protected $primaryKey = 'idVeiculo';

    protected $fillable = [
        'placa',
        'modelo',
        'capacidade',
        'ano',
        'marca',
        'idMotorista'
    ];

    // Relacionamento com Motorista (Veículo pertence a um motorista)
    public function motorista()
    {
        return $this->belongsTo(Motorista::class, 'idMotorista');
    }

    // Relacionamento com Aluno (Veículo transporta vários alunos)
    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'idVeiculo');
    }
}
