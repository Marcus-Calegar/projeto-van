<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = 'solicitacoes';
    protected $primaryKey = 'idSolicitacao';

    protected $fillable = [
        'idResponsavel',
        'idMotorista',
        'idAluno',
        'status'
    ];

    // Relacionamento com Responsavel (Solicitação pertence a um Responsável)
    public function responsavel()
    {
        return $this->belongsTo(Responsavel::class, 'idResponsavel');
    }

    // Relacionamento com Motorista (Solicitação pertence a um Motorista)
    public function motorista()
    {
        return $this->belongsTo(Motorista::class, 'idMotorista');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'idAluno');
    }
}
