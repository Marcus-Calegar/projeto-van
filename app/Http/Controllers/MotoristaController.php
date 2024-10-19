<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function create()
    {
        return view('motorista.create'); // View específica para cadastrar motorista
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:100'],
            'telefone' => ['required', 'string', 'max:11'],
            'cpf' => ['required', 'string', 'max:11'],
            'mensalidade' => ['required', 'decimal:8,2'],
            'dataNascimento' => ['required', 'date'],
        ]);
        
        Motorista::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'idUsuario' => $request->id,
            'cpf' => $request->cpf,
            'mensalidade' => $request->mensalidade,
            'dataNascimento' => $request->dataNascimento
        ]);

        return redirect()->route('dashboard')->with('status', 'Motorista cadastrado com sucesso!');
    }
}
