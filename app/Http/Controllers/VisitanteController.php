<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    public function store(Request $request){
        $NovoVisitante = ['nome_visitante' => $request->visitante, 'rg_visitante' => $request->RGvisitante, 'cpf_visitante' => $request->CPFvisitante];
        Visitante::create($NovoVisitante);

        return response()->json(
            [
                'status' => 200,
            ]);
    }
}
