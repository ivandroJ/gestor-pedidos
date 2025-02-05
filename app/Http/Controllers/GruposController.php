<?php

namespace App\Http\Controllers;

use App\Actions\Pedidos\TransformCurrencyFormatToNumericAction;
use App\Http\Requests\grupos\StoreGrupoRequest;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GruposController extends Controller
{

    public function index()
    {
        $grupos = Auth::user()->grupos;
        $page_title = 'Grupos';
        $back_url = '/';

        return view('grupos.index', compact('grupos', 'back_url', 'page_title'));
    }


    public function store(StoreGrupoRequest $request, TransformCurrencyFormatToNumericAction $action)
    {

        $saldoPermitido = $action->execute(request('saldoPermitido'));

        $grupo = Grupo::create([
            'nome' => request('nome'),
            'saldoPermitido' => $saldoPermitido,
            'aprovador_id' => $request->user()->id
        ]);

        return redirect('/grupos')
            ->with('sucesso_msg', "Grupo '{$grupo->nome}' criado com sucesso!");
    }
}
