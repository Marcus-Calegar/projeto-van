<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    protected $table = 'responsaveis';
    protected $primaryKey = 'idResponsavel';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'dataNascimento',
        'idUsuario'
    ];

    // Relacionamento com Usuario (Responsável pertence a um Usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relacionamento com Aluno (Responsável pode ter muitos alunos)
    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'idResponsavel');
    }

    // Relacionamento com Solicitações (Responsável pode fazer várias solicitações)
    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class, 'idResponsavel');
    }
}
