<?php

namespace App\Http\Controllers;

use App\Models\Responsavel;
use Illuminate\Http\Request;

class ResponsavelController extends Controller
{
    //
    public function create()
    {
        return view('responsavel.create');
    }

    public function store(Request $request){

        $request->validate([
            'nome' => ['required', 'string', 'max:100'],
            'telefone' => ['required', 'string', 'max:11'],
            'cpf' => ['required', 'string', 'max:11'],
            'dataNascimento' => ['required', 'date'],
        ]);
        
        Responsavel::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'idUsuario' => $request->id,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento
        ]);

        return redirect()->route('dashboard')->with('status', 'Responsavel cadastrado com sucesso!');
    }
}
