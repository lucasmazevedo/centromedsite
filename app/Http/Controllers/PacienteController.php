<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\Exame;
use App\Models\Laudo;
use App\Models\Modelo;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Auth;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PacienteController extends Controller
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
            $data = Paciente::with('exames')->select('*')->orderBy('data', 'DESC');
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('nome', function(Paciente $paciente) {
                        if($paciente->sexo == 0)
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
                                <span class="text-gray-800 fw-bold fs-6">' . $paciente->nome . '</span>
                            </div>
                        </div>';
                    })
                    ->editColumn('dadospaciente', function(Paciente $paciente) {
                        return '
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-start flex-column">
                            <span class="text-gray-800 fw-semibold d-block fs-7">Data de Nascimento: <b>' . Carbon::createFromFormat('Y-m-d', $paciente->dtnascimento)->format('d/m/Y') . '</b></span>
                            <span class="text-gray-800 fw-semibold d-block fs-7">CPF: <b>' . $this->formatCPF($paciente->cpf) . '</b></span>
                            </div>
                        </div>';
                    })
                    ->editColumn('created_at', function(Paciente $paciente) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $paciente->created_at)->format('d/m/Y');
                    })
                    ->addColumn('exames', function($row){
                        return "<span class='badge badge-info'>". $row->exames->count() ."</span>";
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a data-attr='. route('pacientes.edit', $row->id) .' id="btn-edit-paciente" class="btn btn-sm btn-icon btn-light-warning btn-hover-scale me-2"><i class="bi bi-pencil-square fs-4"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action', 'dadospaciente', 'nome', 'exames'])
                    ->make(true);
        }

        return view('pacientes.index');
    }

    public function dadosPaciente($id)
    {
        $paciente = Paciente::findOrFail($id);
        return \Response::json(["data" => $paciente], 200);
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
        $paciente = Paciente::findOrFail($id);
        return \Response::json(\View::make('pacientes.edit', compact('paciente'))->render());
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
        $paciente = Paciente::findOrFail($id);
        $paciente->nome = $request->get('nome');
        $paciente->sexo = $request->get('sexo');
        $paciente->dtnascimento = Carbon::createFromFormat('d/m/Y', $request->get('dtnascimento'))->format('Y-m-d');
        $paciente->cpf = $this->unformatCPF($request->get('cpf'));
        $paciente->update();
        return response()->json(['success'=>'Paciente Alterado com Sucesso!'], 200);
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

    private function formatCPF($cpf)
    {
        $pattern = '/^([[:digit:]]{3})([[:digit:]]{3})([[:digit:]]{3})([[:digit:]]{2})$/';
        $replacement = '$1.$2.$3-$4';
        return preg_replace($pattern, $replacement, $cpf);//000.000.000-00
    }

    private function unformatCPF($cpf)
    {
        $cpf = trim($cpf);
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace(",", "", $cpf);
        $cpf = str_replace("-", "", $cpf);
        $cpf = str_replace("/", "", $cpf);
        return $cpf;
    }
}
