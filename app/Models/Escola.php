<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    protected $table = 'escolas';
    protected $primaryKey = 'idEscola';

    protected $fillable = [
        'nome',
        'idEndereco'
    ];

    // Relacionamento com Endereco (Escola tem um endereço)
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'idEndereco');
    }

    // Relacionamento com Aluno (Escola tem vários alunos)
    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'idEscola');
    }

    // Relacionamento com Motoristas (Escola pode estar associada a muitos motoristas)
    public function motoristas()
    {
        return $this->belongsToMany(Motorista::class, 'motoristaescola', 'idEscola', 'idMotorista');
    }
}
