<?php

namespace App\Http\Controllers;

use App\Http\Requests\grupos\StoreGrupoRequest;
use App\Models\Grupo;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = request()->user()->grupos;

        $back_url = '/';

        return view('grupos.index', compact('grupos', 'back_url'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect('/grupos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGrupoRequest $request)
    {
        $grupo = Grupo::create($request->only(
            ['nome', 'saldoPermitido']
        ) + ['aprovador_id' => $request->user()->id]);

        return redirect('/grupos')->with('sucesso_msg', "Grupo '{$grupo->nome}' criado com sucesso!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grupo $grupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        //
    }
}
