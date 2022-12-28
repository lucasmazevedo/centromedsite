<?php

namespace App\Http\Controllers;

use App\Models\Exame;
use App\Models\Captura;
use App\Models\Modalidade;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Http;
use File;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class ExameController extends Controller
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

        $agent = new Agent();
        if($agent->isMobile())
        {
            return redirect()->route('app.mobile');
        }


        if ($request->ajax()) {
            // dd($request->get('search'));
                if($request->has('situacao'))
                {
                    if($request->get('situacao') == "1")
                    {
                        $data = Exame::with('paciente')->select('*')->orderBy('data', 'DESC')->where('situacao', 0);
                    }elseif($request->get('situacao') == "2")
                    {
                        $data = Exame::with('paciente')->select('*')->orderBy('data', 'DESC')->where('situacao', 1);
                    }elseif($request->get('situacao') == "3")
                    {
                        $data = Exame::with('paciente')->select('*')->orderBy('data', 'DESC')->where('situacao', 4);
                    }
                }else{
                    $data = Exame::with('paciente')->select('*')->orderBy('data', 'DESC')->where('situacao', 0);
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
                        if($row->getAttributes()['situacao'] == 0)
                        {
                            $btn = '<a href='. route('exames.captura', $row->id) .' class="btn btn-sm btn-icon btn-light-primary btn-hover-scale me-2"><i class="bi bi-camera-video-fill fs-4"></i></a>
                            <a data-attr='. route('exames.edit', $row->id) .' id="btn-edit-exame" class="btn btn-sm btn-icon btn-light-warning btn-hover-scale me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a data-attr='. route('exames.destroy', $row->id) .' data-exame="'. $row->nome .'" id="btn-destroy-exame" class="btn btn-sm btn-icon btn-light-danger btn-hover-scale me-2"><i class="bi bi-x-circle-fill fs-4"></i></a>';
                        }elseif($row->getAttributes()['situacao'] == 1)
                        {
                            $btn = '<a href='. route('exames.captura', $row->id) .' class="btn btn-sm btn-icon btn-light-primary btn-hover-scale me-2"><i class="bi bi-camera-video-fill fs-4"></i></a>
                            <a target="_Blank" href='. route('exame.printImagem', $row->id) .' class="btn btn-sm btn-icon btn-light-info btn-hover-scale me-2"><i class="bi bi-file-earmark-image fs-4"></i></a>
                            <a href='. route('exame.sendPacs', $row->id) .' class="btn btn-sm btn-icon btn-light-info btn-hover-scale me-2"><i class="bi bi-cloud-arrow-up-fill fs-4"></i></a>
                            <a data-attr='. route('exames.edit', $row->id) .' id="btn-edit-exame" class="btn btn-sm btn-icon btn-light-warning btn-hover-scale me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a data-attr='. route('exames.destroy', $row->id) .' data-exame="'. $row->nome .'" id="btn-destroy-exame" class="btn btn-sm btn-icon btn-light-danger btn-hover-scale me-2"><i class="bi bi-x-circle-fill fs-4"></i></a>';
                        }elseif($row->getAttributes()['situacao'] == 2)
                        {
                            $btn = "";
                        }elseif($row->getAttributes()['situacao'] == 2)
                        {
                            $btn = "";
                        }elseif($row->getAttributes()['situacao'] == 3)
                        {
                            $btn = "";
                        }elseif($row->getAttributes()['situacao'] == 4)
                        {
                            $btn = '<a data-attr='. route('exames.edit', $row->id) .' id="btn-edit-exame" class="btn btn-sm btn-icon btn-light-warning btn-hover-scale me-2"><i class="bi bi-pencil-square fs-4"></i></a>';
                        }


                            return $btn;
                    })
                    ->rawColumns(['action', 'nome', 'paciente', 'data', 'situacao'])
                    ->make(true);
        }

        return view('exames.index');
    }

    public function captura($id)
    {
        $exame = Exame::findOrFail($id);
        return view('exames.captura', compact('exame'));
    }

    public function capturaImagem(Request $request, $id)
    {
        $captura = New Captura();
        $image = $request->get("image");
        $base64Image = explode(";base64,", $image);
        $explodeImage = explode("image/", $base64Image[0]);
        $imageType = $explodeImage[1];
        $image_base64 = base64_decode($base64Image[1]);
        $fileName = uniqid() . '.' . $imageType;
        $captura->image = $fileName;
        $captura->image_blob = $image_base64;
        $captura->exame_id = $id;
        $captura->save();
        return response()->json(['code' => 200, 'message' => 'Imagens Capturadas com Sucesso!!'], 200);
    }

    public function recuperaImagens($id)
    {
        $exame = Exame::findOrFail($id);
        return \Response::json(\View::make('exames.imagens', compact('exame'))->render());
    }

    public function deleteImagem($id)
    {
        $captura = Captura::findOrFail($id);
        $captura->delete();
        return response()->json(['code' => 200, 'message' => 'Imagem Deletada com Sucesso!!'], 200);
    }


    public function finalizarCaptura($id)
    {
        $exame = Exame::findOrFail($id);
        $exame->situacao = 1;
        $exame->update();
        return redirect()->route('exames.index')->with('success', 'Captura de exame finalizada com sucesso!');
    }

    public function cancelarCaptura($id)
    {
        $exame = Exame::findOrFail($id);
        if($exame->getAttributes()['situacao'] == 0)
        {
            foreach($exame->imagens as $imagem)
            {
                $imagem->delete();
            }

        }
        $exame->update();
        return redirect()->route('exames.index')->with('success', 'Captura de exame cancelada com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $pacientes = Paciente::all();
        return \Response::json(\View::make('exames.create', compact('pacientes'))->render());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->get('pacienteId'))
        {
            $cpf = preg_replace('/[^0-9]/', '', $request->get('pacienteCPF'));
            switch ($request->get('pacienteSexo')) {
                case 'M':
                    $pacienteSexo = 0;
                    break;
                case 'F':
                    $pacienteSexo = 1;
                    break;
            };

            $paciente = new Paciente();
            $paciente->nome = $request->get('pacienteNome');
            $paciente->cpf = $cpf;
            $paciente->dtnascimento = Carbon::createFromFormat('d/m/Y', $request->get('pacienteDtNascimento'))->format("Y-m-d");
            $paciente->sexo = $pacienteSexo;
            $paciente->save();
            $pacienteDataId = $paciente->id;
        }else{
            $pacienteDataId = $request->get('pacienteId');
        }
        foreach($request->get('exames') as $exameData)
        {
            $modalidade = Modalidade::where('abbr', $exameData['modalidade'])->first();
            $exame = new Exame();
            $exame->nome = $exameData['exame'];
            $exame->data = Carbon::createFromFormat('d/m/Y H:i', $exameData['data'])->format("Y-m-d H:i:s");
            $exame->modalidade_id = $modalidade->id;
            $exame->paciente_id = $pacienteDataId;
            $exame->user_id = Auth::user()->id;
            $exame->save();
        }
        return response()->json(['success'=>'Exame(s) Cadastrados com Sucesso!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('exames.teste');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exame = Exame::findOrFail($id);
        $modalidades = Modalidade::all();
        return \Response::json(\View::make('exames.edit', compact('exame', 'modalidades'))->render());
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
            $exame = Exame::findOrFail($id);
            $exame->nome = $request->get('nome');
            $exame->data = Carbon::createFromFormat('d/m/Y H:i', $request->get('data'))->format("Y-m-d H:i:s");
            $exame->modalidade_id = $request->get('modalidade');
            $exame->update();
            return response()->json(['success'=>'Exame(s) Alterado com Sucesso!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exame = Exame::findOrFail($id);
        $exame->situacao = 4;
        $exame->update();
        return response()->json(['success'=>'Exame(s) cancelado com Sucesso!'], 200);
    }



    public function printImagem($id)
    {
        $data = Exame::with('imagens')->findOrFail($id);

        $headerHtml = view()->make('layouts.imagempdf.header', ["data" => $data])->render();
        $footerHtml = view()->make('layouts.imagempdf.footer', ["data" => $data])->render();

        $pdf = PDF::loadView('layouts.imagempdf.content', ["data" => $data])
        ->setPaper('a4')
        ->setOption('encoding', 'UTF-8')
        ->setOrientation('portrait')
        ->setOption('margin-top', '40mm')
        ->setOption('margin-bottom', '20mm')
        ->setOption('footer-line', true)
        ->setOption('header-spacing', '10')
        ->setOption('enable-local-file-access', true)
        ->setOption('footer-font-size', 8)
        ->setOption('footer-right', 'Página [page] de [toPage]')
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($data->paciente->nome);
    }

    public function sendPacs(Request $request, $id)
    {
        $orthanc = "http://45.55.125.81:8042/";
        $exame = Exame::findOrFail($id);

        $path = $exame->empresa->logo;
        // dd($path);
        $mine = "png";

        $images = [];
        foreach ($exame->imagens as $imagem) {
            $path = $imagem->image_blob;
            $mine = "png";
            array_push($images, $this->data_uri($mine, $path));
        }
        // //Define the DICOM Tags & PNG File, build query
        $patientID = "P-" . str_pad($exame->paciente->id, 4, '0', STR_PAD_LEFT);
        if ($exame->paciente->sexo == "0") {
            $patientSex = "M";
        } elseif ($exame->paciente->sexo == "1") {
            $patientSex = "F";
        }

        $tagsDicom = array(
            "PatientName" => $exame->paciente->nome,
            "PatientID" => $patientID,
            "StudyID" => "E-" . str_pad($exame->id, 4, '0', STR_PAD_LEFT),
            "StudyDescription" => $exame->nome,
            "StudyDate" => \Carbon\Carbon::parse($exame->data)->format('Ymd'),
            "StudyTime" => \Carbon\Carbon::parse($exame->data)->format('His'),
            "AccessionNumber" => $patientID,
            "PatientSex" => $patientSex,
            "PatientBirthDate" => \Carbon\Carbon::parse($exame->paciente->dtnascimento)->format('Ymd'),
            "InstitutionName" => "CENTROMED",
            "SOPClassUID" => "1.2.840.10008.5.1.4.1.1.7", //SC
            "Modality" => $exame->modalidade->abbr,
        );
        $dataDicom = array(
            "Tags" => $tagsDicom,
            "Content" => $images
        );
        $response = Http::post($orthanc . '/tools/create-dicom', $dataDicom);
        $jsonData = $response->json();

        return redirect()->route('exames.index')
            ->with('success', 'Exame enviado para o PACS!');
    }

    private function data_uri($mine, $path)
    {
        // $contents = file_get_contents($path);
        $base64   = base64_encode($path);
        return ('data:image/' . $mine . ';base64,' . $base64);
    }

    private function createCurlPostFieldsData($inputArray)
    {
        $string = "{";
        foreach ($inputArray as $tag => $value) {
            $string = $string . "\"" . $tag . "\":\"" . $value . "\",";
        }
        $string = rtrim($string, ',');
        $string = $string . "}";
        return $string;
    }
}
