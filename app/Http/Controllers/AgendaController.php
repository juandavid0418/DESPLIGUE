<?php

namespace App\Http\Controllers;
use App\Models\Contrato;
use App\Models\Ep;
use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;




/**
 * Class AgendaController
 * @package App\Http\Controllers
 */
class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');
    
        $query = Agenda::query();
    
        if ($busqueda) {
            $query->where('id', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('id_pacientes', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('id_user', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('fecha_inicio', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('fecha_fin', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('hora', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('hora_fin', 'LIKE', '%' . $busqueda . '%');
        }
    
        $agendas = $query->latest('id')->paginate();
    
        return view('agenda.index', compact('agendas'))
            ->with('i', (request()->input('page', 1) - 1) * $agendas->perPage());
    }

    public function pdf(){

        $agendas=Agenda::all();
        $pdf = Pdf::loadView('Agenda.pdf', compact('agendas'));
        return $pdf->stream();

    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agenda = new Agenda();
        $pacientes = Paciente::pluck('nombre','id');
        $user = User::where('IdRol', 2)->pluck('name', 'id');
        $contrato = Contrato::where('contratos.estado', 0)
        ->join('eps', 'contratos.idEps', '=', 'eps.id')
        ->select(DB::raw("CONCAT(eps.eps, ' - ', contratos.Nro_contrato) as display"), 'contratos.id')
        ->pluck('display', 'contratos.id');
        $eps = Ep::pluck('eps','id');
        return view('agenda.create', compact('agenda','pacientes','user','contrato','eps'));
    }

    public function store(Request $request)
    {
        $rules = [
            'idContrato' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'hora' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora',
            'id_pacientes' => 'required',
            'id_user' => 'required',
        ];
    
        $messages = [
            'required' => 'El campo es obligatorio.',
            'date' => 'El campo debe ser una fecha válida.',
            'after_or_equal' => 'La fecha de finalización debe ser posterior o igual a la fecha de inicio.',
            'date_format' => 'El formato de la hora es inválido.',
            'after' => 'La hora de finalización debe ser posterior a la hora de inicio.'
        ];

        $validatedData = $request->validate($rules, $messages);

        $contrato = Contrato::find($request->input('idContrato'));

        if (!$contrato || ($validatedData['fecha_inicio'] < $contrato->fecha_inicio) || ($validatedData['fecha_fin'] > $contrato->fecha_fin)) {
            return redirect()->back()->withErrors('Las fechas seleccionadas están fuera del rango permitido del contrato.');
        } 
        $agenda = Agenda::create($validatedData);

        $paciente = Paciente::findOrFail($validatedData['id_pacientes']);
        $paciente->ejecucion = 1;
        $paciente->save();
    
        $user = User::findOrFail($validatedData['id_user']);
        $user->ejecucion = 1;
        $user->save();
        
        return redirect()->route('Agenda.index')
            ->with('success', 'Agenda creada correctamente.');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenda = Agenda::find($id);

        return view('agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agenda = Agenda::find($id);
        $pacientes = Paciente::pluck('nombre','id');
        $user = User::pluck('name','id');
        $contrato = Contrato::where('estado', 0)
        ->join('eps', 'contratos.idEps', '=', 'eps.id')
        ->selectRaw("concat(eps.eps, ' - ', contratos.Nro_contrato) as eps_contrato, contratos.id")
        ->pluck('eps_contrato', 'contratos.id');     
        return view('agenda.edit', compact('agenda','pacientes','user','contrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $rules = [
        'idContrato' => '',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'hora' => 'required|date_format:H:i',
        'hora_fin' => 'required|date_format:H:i|after:hora',
        'id_pacientes' => '',
        'id_user' => '',
    ];

    $messages = [
        'required' => 'El campo es obligatorio.',
        'date' => 'El campo debe ser una fecha válida.',
        'after_or_equal' => 'La fecha de finalización debe ser posterior o igual a la fecha de inicio.',
        'date_format' => 'El formato de la hora es inválido.',
        'after' => 'La hora de finalización debe ser posterior a la hora de inicio.'
    ];

    $validatedData = $request->validate($rules, $messages);
    $contrato = Contrato::find($request->input('idContrato'));

    $agenda = Agenda::findOrFail($id);
    $agenda->update($validatedData);

    return redirect()->route('Agenda.index')
        ->with('success', 'Agenda Actualizada .');
}

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $agenda = Agenda::find($id)->delete();

        return redirect()->route('Agenda.index')
            ->with('success', 'Agenda eliminado con éxito');
    }
}

///API

