<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    protected $table = 'motoristas';
    protected $primaryKey = 'idMotorista';

    protected $fillable = [
        'nome',
        'telefone',
        'cpf',
        'mensalidade',
        'dataNascimento',
        'idUsuario'
    ];

    // Relacionamento com Usuario (Motorista pertence a um Usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relacionamento com Veiculo (Motorista tem vários veículos)
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'idMotorista');
    }

    // Relacionamento com Solicitacoes (Motorista tem várias solicitações)
    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class, 'idMotorista');
    }

    // Relacionamento com MotoristaEscola (Motorista pode ter muitas escolas associadas)
    public function escolas()
    {
        return $this->belongsToMany(Escola::class, 'motoristaescola', 'idMotorista', 'idEscola');
    }
}
