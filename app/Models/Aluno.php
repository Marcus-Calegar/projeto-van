<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';
    protected $primaryKey = 'idAluno';

    protected $fillable = [
        'nome',
        'dataNascimento',
        'idEscola',
        'idUsuario',
        'idResponsavel',
        'idEndereco',
        'idVeiculo'
    ];

    // Relacionamento com Usuario (Aluno pertence a um Usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relacionamento com Responsavel (Aluno tem um responsável)
    public function responsavel()
    {
        return $this->belongsTo(Responsavel::class, 'idResponsavel');
    }

    // Relacionamento com Endereco (Aluno tem um endereço)
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'idEndereco');
    }

    // Relacionamento com Escola (Aluno pertence a uma escola)
    public function escola()
    {
        return $this->belongsTo(Escola::class, 'idEscola');
    }

    // Relacionamento com Veiculo (Aluno utiliza um veículo)
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'idVeiculo');
    }
}
