<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exame;
use Carbon\Carbon;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Auth;

class RelatorioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $examesP = Exame::where('situacao', 0)->count();
        $examesC = Exame::where('situacao', 1)->count();
        $examesCL = Exame::where('situacao', 3)->count();
        $examesD = Exame::where('situacao', 4)->count();

        return view('relatorios.index', compact('examesP', 'examesC', 'examesCL', 'examesD'));
    }


    public function gerarRelatorio(Request $request)
    {

        $data = explode(' - ', $request->input('dt_filtro'));
        $start = Carbon::createFromFormat('!d/m/Y', $data[0]);
        $end = Carbon::createFromFormat('d/m/Y H:i:s', $data[1] . "23:59:59");
        $status = $request->get('status');
        // $request->get('tipo_filtro');
        // $request->get('dt_filtro');
        // $request->get('status'); // 0 = TOdos | 1 =Capturados | 2 = laudados


        if ($request->input('tipo_filtro') == "laudo") {
            $exames = Exame::with('laudo')->where('situacao', 3)->whereHas('laudo', function($query) use ($start, $end) {
                $query->whereBetween('data', [$start, $end]);
            });
            
        } else {
            if($status == 0)
            {
                $exames = Exame::with('laudo')->whereBetween('data', [$start, $end]);
            }else{
                $exames = Exame::with('laudo')->where('situacao', $status)->whereBetween('data', [$start, $end]);
            }
        }   


        $headerHtml = view()->make('layouts.relatorios.header', ['dataRel' => $request->get('dt_filtro'), "empresa" => $request->session()->get('empresaAtiva.nome'), "user" => Auth::user()])->render();

        $pdf = PDF::loadView('layouts.relatorios.relatorios', ["data" => $exames->get(), 'dataRel' => $request->get('dt_filtro')])
        ->setPaper('a4')
        ->setOption('encoding', 'UTF-8')
        ->setOrientation('landscape')
        ->setOption('enable-local-file-access', true)
        ->setOption('header-html', $headerHtml)
        ->setOption('header-spacing', '5')
        ->setOption('margin-top', '30mm')
        ->setOption('margin-bottom', '25mm');
        return $pdf->inline("Relatório de Exames");
    }
}