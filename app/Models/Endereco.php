<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'idEndereco';

    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'complemento',
        'uf',
        'estado'
    ];

    // Relacionamento com Aluno (Endereço pode estar associado a muitos alunos)
    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'idEndereco');
    }

    // Relacionamento com Escola (Endereço pode estar associado a muitas escolas)
    public function escolas()
    {
        return $this->hasMany(Escola::class, 'idEndereco');
    }
}
