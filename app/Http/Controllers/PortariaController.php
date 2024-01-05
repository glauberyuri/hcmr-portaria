<?php

namespace App\Http\Controllers;

use App\Models\Portaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortariaController extends Controller
{
    public function store(Request $request) {
        // Crie a Portaria
        $portaria = Portaria::create([
            'nome_paciente' => $request->nome_paciente,
            'unidade_internacao' => $request->unidade_internacao,
            'observacao' => $request->observacao,
            'parentesco_visitante' => $request->parentescoVisitante,
            'visitante_id'=> $request->visitanteSelect,
            'user_id' => Auth::user()->id, // Certifique-se de adicionar o user_id aqui
        ]);

        return response()->json([
            'status' => 200,
        ]);
    }

}
