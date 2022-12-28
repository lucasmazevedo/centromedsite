<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Exame;
use App\Models\Modalidade;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $countAgendamentos = Auth::user()->exames()->count();

        $totalRepasse = intval($countAgendamentos) * intval(config('app.valor_repasse'));
        $repasse = 'R$ ' . number_format(floatval($totalRepasse), 2, ',', '.');

        return view('mobile.app.index', compact('countAgendamentos', 'repasse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agendas = Agenda::where('data_agenda', '>=', date("Y-m-d"))->get();
        return view('mobile.app.novoAgendamento', compact('agendas') );
    }

    public function createPaciente($id)
    {
        $agenda = Agenda::findOrFail($id);
        $pacientes = Paciente::all();
        return view('mobile.app.agendamentoPaciente', compact('pacientes', 'agenda'));
    }

    public function createExame($agenda, $paciente = null)
    {
        if($paciente != null)
        {
            $paciente = Paciente::findOrFail($paciente);
            $agenda = Agenda::findOrFail($agenda);
            $modalidades = Modalidade::all();
            return view('mobile.app.agendamentoExamePaciente', compact('paciente', 'modalidades', 'agenda'));
        }else{
            $agenda = Agenda::findOrFail($agenda);
            $modalidades = Modalidade::all();
            return view('mobile.app.agendamentoExame', compact('agenda', 'modalidades'));
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'exame' => 'required',
            'paciente' => 'required',
            'agenda' => 'required',
            'modalidade' => 'required',
        ]);

        $modalidade = Modalidade::where('abbr', $request->get('modalidade'))->first();
        $agenda = Agenda::findOrFail($request->get('agenda'));
        $paciente = Paciente::findOrFail($request->get('paciente'));
        $exame = new Exame();
        $exame->nome = $request->get('exame');
        $exame->data = $agenda->data_agenda;
        $exame->modalidade_id = $modalidade->id;
        $exame->paciente_id = $paciente->id;
        $exame->user_id = Auth::user()->id;
        $exame->save();
        return redirect()->route('app.mobile')->with('status', 'Agendamento realizado com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePaciente(Request $request)
    {
        $request->validate([
            'pNome' => 'required',
            'pNascimento' => 'required',
            'pCpf' => 'required',
            'pSexo' => 'required',
            'exame' => 'required',
            'agenda' => 'required',
            'modalidade' => 'required',
        ],[
            'pNome.required' => 'O nome do paciente é obrigatório.',
            'pNascimento.required' => 'A data de nascimento do paciente é obrigatório.',
            'pCpf.required' => 'O CPF do paciente é obrigatório.',
            'pSexo.required' => 'O sexo do paciente é obrigatório.',
            'exame.required' => 'O nome do exame é obrigatório.',
            'paciente.required' => 'Selecione um paciente.',
            'agenda.required' => 'Selecione uma data para agendamento.',
            'modalidade.required' => 'Selecione uma modalidade'
        ]);

        $cpf = preg_replace('/[^0-9]/', '', $request->get('pCpf'));
            switch ($request->get('pSexo')) {
                case 'M':
                    $pacienteSexo = 0;
                    break;
                case 'F':
                    $pacienteSexo = 1;
                    break;
            };
            $paciente = new Paciente();
            $paciente->nome = $request->get('pNome');
            $paciente->cpf = $cpf;
            $paciente->dtnascimento = Carbon::createFromFormat('d/m/Y', $request->get('pNascimento'))->format("Y-m-d");
            $paciente->sexo = $pacienteSexo;
            $paciente->save();
        $modalidade = Modalidade::where('abbr', $request->get('modalidade'))->first();
        $agenda = Agenda::findOrFail($request->get('agenda'));
        $exame = new Exame();
        $exame->nome = $request->get('exame');
        $exame->data = $agenda->data_agenda;
        $exame->modalidade_id = $modalidade->id;
        $exame->paciente_id = $paciente->id;
        $exame->user_id = Auth::user()->id;
        $exame->save();
        return redirect()->route('app.mobile')->with('status', 'Agendamento realizado com sucesso!');
    }

    public function messages()
    {
        return [
            'pNome.required' => 'O nome do paciente é obrigatório.',
            'pNascimento.required' => 'A data de nascimento do paciente é obrigatório.',
            'pCpf.required' => 'O CPF do paciente é obrigatório.',
            'pSexo.required' => 'O sexo do paciente é obrigatório.',
            'exame.required' => 'O nome do exame é obrigatório.',
            'paciente.required' => 'Selecione um paciente.',
            'agenda.required' => 'Selecione uma data para agendamento.',
            'modalidade.required' => 'Selecione uma modalidade',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $agendamentos = Exame::where('user_id', '=', Auth::user()->id)->get();
        $totalRepasse = intval($agendamentos->count()) * intval(config('app.valor_repasse'));
        $repasse = 'R$ ' . number_format(floatval($totalRepasse), 2, ',', '.');
        return view('mobile.app.agendamentosRealizados', compact('agendamentos', 'repasse'));
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
