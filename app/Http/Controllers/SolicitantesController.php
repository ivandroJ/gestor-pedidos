<?php

namespace App\Http\Controllers;

use App\Http\Requests\solicitantes\StoreSolicitantesRequest;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitantes = Solicitante::whereHas('grupo', function ($grupo) {
            $grupo->where('aprovador_id', request()->user()->id);
        })->with('usuario', 'grupo')->get()->sortBy('usuario.nome');

        return view('solicitantes.index', compact('solicitantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect('/solicitantes');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSolicitantesRequest $request)
    {
       //
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitante $solicitante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitante $solicitante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitante $solicitante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitante $solicitante)
    {
        //
    }
}
