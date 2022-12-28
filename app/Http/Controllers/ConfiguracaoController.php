<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class ConfiguracaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empresa = Empresa::findOrFail($request->session()->get('empresaAtiva.id'));
        return view('configuracoes.index', compact('empresa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $empresa = Empresa::findOrFail($request->session()->get('empresaAtiva.id'));
        $empresa->nome = $request->get('nome');
        $empresa->idpacs = $request->get('idpacs');
        $empresa->rodape = $request->get('rodape');
        // $empresa->nome -> $request->get('nome');

        if($request->has('image'))
        {
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->store('uploads');
            $empresa->logo =  $path;

        }

        $empresa->update();

        return redirect()->route('configuracoes.index')->with('success', 'Informações atualizadas com sucesso...');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
