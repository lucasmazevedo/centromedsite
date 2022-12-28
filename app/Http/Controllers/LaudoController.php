<?php

namespace App\Http\Controllers;

use App\Models\Exame;
use App\Models\Laudo;
use App\Models\Modelo;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Auth;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class LaudoController extends Controller
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
        if ($request->ajax()) {
            // dd($request->get('search'));
                if($request->has('situacao'))
                {
                    if($request->get('situacao') == "1")
                    {
                        $data = Exame::with('paciente')->select('*')->orderBy('data', 'DESC')->where('situacao', 1)->orWhere('situacao', 2);
                    }elseif($request->get('situacao') == "2")
                    {
                        $data = Exame::with('paciente')->select('*')->orderBy('data', 'DESC')->where('situacao', 2);
                    }elseif($request->get('situacao') == "3")
                    {
                        $data = Exame::with('paciente')->select('*')->orderBy('data', 'DESC')->where('situacao', 3);
                    }
                }else{
                    $data = Exame::with('paciente')->select('*')->orderBy('data', 'DESC')->where('situacao', 1);
                }
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('paciente', function(Exame $exame) {
                        if($exame->paciente->sexo == 0)
                        {
                            $htmlSexo = '<span class="badge py-3 px-4 fs-7 badge-light-primary"><i class="bi bi-person-fill fs-2 text-primary"></i></span>';
                        }else{
                            $htmlSexo = '<span class="badge py-3 px-4 fs-7 badge-light-danger"><i class="bi bi-person-fill fs-2 text-danger"></i></span>';
                        }
                        return '
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-25px me-3">'. $htmlSexo .'
                            </div>
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-gray-800 fw-bold fs-6">' . $exame->paciente->nome . '</span>
                                <span class="text-gray-800 fw-semibold d-block fs-7">Data de Nascimento: ' . Carbon::createFromFormat('Y-m-d', $exame->paciente->dtnascimento)->format('d/m/Y') . '</span>
                            </div>
                        </div>';
                    })
                    ->editColumn('nome', function(Exame $exame) {
                        return '
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-gray-800 fw-bold mb-1 fs-6">' . $exame->nome . '</span>
                                <span class="text-gray-800 fw-semibold d-block fs-7">Modalidade: ' . $exame->modalidade->abbr . '</span>
                            </div>
                        </div>';
                    })
                    ->editColumn('situacao', function(Exame $exame) {
                        if($exame->getAttributes()['situacao'] == 3)
                        {
                            return '
                            <div class="">
                                <div class="d-flex justify-content-start flex-column">
                                    <span class="text-success fw-bold fs-6">Laudo Assinado em ' . Carbon::parse($exame->laudo->data)->format('d/m/Y') . '</span>
                                    <span class="text-success fw-bold fs-6">Dr. ' . $exame->laudo->user->name . '</span>
                                </div>
                            </div>';

                        }else{
                            return $exame->situacao;
                        }
                    })
                    ->editColumn('data', function(Exame $exame) {
                        return '
                        <div class="">
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-gray-800 fw-bold fs-6">' . Carbon::parse($exame->data)->format('d/m/Y') . '</span>
                                <span class="text-gray-800 fw-bold fs-6">' . Carbon::parse($exame->data)->format('H:i') . 'h</span>
                            </div>
                        </div>';
                    })
                    ->addColumn('action', function($row){
                        if($row->getAttributes()['situacao'] == 1)
                        {
                            $btn = '<a href='. route('laudos.laudar', $row->id) .' class="btn btn-sm btn-icon btn-light-primary btn-hover-scale me-2"><i class="bi bi-journal-medical fs-4"></i></a>
                            <a data-attr='. route('exames.edit', $row->id) .' id="btn-edit-exame" class="btn btn-sm btn-icon btn-light-warning btn-hover-scale me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a data-attr='. route('exames.destroy', $row->id) .' data-exame="'. $row->nome .'" id="btn-destroy-exame" class="btn btn-sm btn-icon btn-light-danger btn-hover-scale me-2"><i class="bi bi-x-circle-fill fs-4"></i></a>';
                        }elseif($row->getAttributes()['situacao'] == 2)
                        {
                            $btn = '
                            <a href='. route('laudos.laudar', $row->id) .' class="btn btn-sm btn-icon btn-light-primary btn-hover-scale me-2"><i class="bi bi-journal-medical fs-4"></i></a>
                            <a href='. route('laudos.laudar', $row->id) .' class="btn btn-sm btn-icon btn-light-info btn-hover-scale me-2"><i class="bi bi-vector-pen fs-4"></i></a>
                            <a data-attr='. route('exames.edit', $row->id) .' id="btn-edit-exame" class="btn btn-sm btn-icon btn-light-warning btn-hover-scale me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a data-attr='. route('exames.destroy', $row->id) .' data-exame="'. $row->nome .'" id="btn-destroy-exame" class="btn btn-sm btn-icon btn-light-danger btn-hover-scale me-2"><i class="bi bi-x-circle-fill fs-4"></i></a>';
                        }elseif($row->getAttributes()['situacao'] == 3)
                        {
                            $btn = '
                            <a target="_Blank" href='. route('laudos.printLaudo', $row->id) .' class="btn btn-sm btn-icon btn-light-primary btn-hover-scale me-2"><i class="bi bi-printer-fill fs-4"></i></a>
                            <a target="_Blank" href='. route('exame.printImagem', $row->id) .' class="btn btn-sm btn-icon btn-light-info btn-hover-scale me-2"><i class="bi bi-file-earmark-image fs-4"></i></a>
                            <a data-attr='. route('exames.edit', $row->id) .' id="btn-edit-exame" class="btn btn-sm btn-icon btn-light-warning btn-hover-scale me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a data-attr='. route('exames.destroy', $row->id) .' data-exame="'. $row->nome .'" id="btn-destroy-exame" class="btn btn-sm btn-icon btn-light-danger btn-hover-scale me-2"><i class="bi bi-x-circle-fill fs-4"></i></a>';
                        }


                            return $btn;
                    })
                    ->rawColumns(['action', 'nome', 'paciente', 'data', 'situacao'])
                    ->make(true);
        }

        return view('laudos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $exame = Exame::with('paciente')->with('imagens')->findOrFail($id);
        $mascaras = Modelo::all();
        return view('laudos.laudo', compact('exame', 'mascaras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $exame = Exame::findOrFail($id);
        if(!$exame->laudo)
        {
            $laudo = new Laudo();
        }else{
            $laudo = $exame->laudo;
        }
        $laudo->conteudo = $request->get('kt_docs_tinymce_basic');
        $laudo->data = Carbon::now();
        $laudo->assinado = false;
        $laudo->user_id = Auth::user()->id;
        $laudo->exame_id = $exame->id;
        $laudo->save();
        $exame->situacao = 3;
        $exame->update();
        return redirect()->route('laudos.index')->with('success', 'Laudo salvo com sucesso!');
    }

    public function printLaudo($id)
    {
        $data = Exame::with('laudo')->with('paciente')->findOrFail($id);
        // return view('layouts.laudospdf.laudos', compact('data'));
        $headerHtml = view()->make('layouts.laudospdf.header', ["data" => $data])->render();
        $footerHtml = view()->make('layouts.laudospdf.footer', ["data" => $data])->render();

        $pdf = PDF::loadView('layouts.laudospdf.laudos', ["data" => $data])
        ->setPaper('a4')
        ->setOption('encoding', 'UTF-8')
        ->setOrientation('portrait')
        ->setOption('enable-local-file-access', true)
        ->setOption('margin-top', '30mm')
        ->setOption('margin-bottom', '25mm')
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($data->paciente->nome . ".pdf");
    }
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
    public function update(Request $request, $id)
    {
        //
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
