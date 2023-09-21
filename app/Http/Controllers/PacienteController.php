<?php

namespace App\Http\Controllers;
use App\Models\Contrato;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\Ep;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class PacienteController
 * @package App\Http\Controllers
 */
class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contrato = Contrato::where('estado', 0)
        ->join('eps', 'contratos.idEps', '=', 'eps.id')
        ->selectRaw("concat(eps.eps, ' - ', contratos.Nro_contrato) as eps_contrato, contratos.id")
        ->pluck('eps_contrato', 'contratos.id');
        $busqueda = $request->busqueda;
        $pacientes = Paciente::with('eps')->where(function ($query) use ($busqueda) {
        $query->where('documento', $busqueda)
              ->orWhere('nombre', 'LIKE', '%' . $busqueda . '%');
        })
        
        ->latest('id')
        ->paginate();

    
        $totalPacientes = Paciente::count();
    
        return view('paciente.index', compact('pacientes', 'totalPacientes','contrato'))
            ->with('i', (request()->input('page', 1) - 1) * $pacientes->perPage());
    }

    public function pdf(){

        $pacientes=Paciente::all();
        $pdf = Pdf::loadView('Paciente.pdf', compact('pacientes'));
        return $pdf->stream();

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paciente = new Paciente();
        $contrato = Contrato::where('estado', 0)
        ->join('eps', 'contratos.idEps', '=', 'eps.id')
        ->selectRaw("concat(eps.eps, ' - ', contratos.Nro_contrato) as eps_contrato, contratos.id")
        ->pluck('eps_contrato', 'contratos.id');    
        $eps = Ep::pluck('eps','id');
        return view('paciente.create', compact('paciente','eps','contrato'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:30', 'min:3', 'regex:/^[A-Za-z ]+$/'],
            'apellido' => ['required', 'string', 'max:30', 'min:5', 'regex:/^[A-Za-z ]+$/'],
            'correo' => 'required|email|unique:pacientes',
            'telefono' => 'required|integer|digits:10',
            'direccion' => 'required|string|max:50|min:10',
            'ciudad' => ['required','string','max:20','min:5', 'regex:/^[A-Za-z ]+$/'],
            'documento' => 'required|string|digits_between:7,10|unique:pacientes',
            'idContrato' => 'required|integer',
        ];
    
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'unique' => 'El campo :attribute ya ha sido registrado.',
            'digits' => 'El campo :attribute debe tener :digits dígitos.',
            'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
            'min' => [
                'string' => 'El campo :attribute debe tener al menos :min caracteres.',
            ],
            'max' => [
                'string' => 'El campo :attribute debe tener  menos de :max caracteres.',
            ],
            'integer' => 'El campo :attribute debe ser un número entero.',  
            'idContrato.required' => 'El campo contrato es obligatorio.',
            'regex' => 'El campo :attribute solo puede contener letras.',

             
        ];

        $validatedData = $request->validate($rules, $messages);
        $paciente = Paciente::create(array_merge($validatedData, ['estado' => 0,'ejecucion' => 0]));
        

        return redirect()->route('Paciente.index')
            ->with('success', 'Paciente creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);

        return view('paciente.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::find($id);
        $eps = Ep::pluck('eps','id');
        $contrato = Contrato::where('estado', 0)
        ->join('eps', 'contratos.idEps', '=', 'eps.id')
        ->selectRaw("concat(eps.eps, ' - ', contratos.Nro_contrato) as eps_contrato, contratos.id")
        ->pluck('eps_contrato', 'contratos.id');    

        return view('paciente.edit', compact('paciente','eps','contrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Paciente $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:30', 'min:3', 'regex:/^[A-Za-z ]+$/'],
            'apellido' => ['required', 'string', 'max:30', 'min:5', 'regex:/^[A-Za-z ]+$/'],
            'correo' => 'required|email|unique:pacientes,correo,' . $id,
            'telefono' => 'required|integer|digits:10',
            'direccion' => 'required|string|max:50|min:5',
            'ciudad' => ['required', 'string', 'max:30', 'min:4', 'regex:/^[A-Za-z ]+$/'],
            'documento' => 'required|string|digits_between:7,10',
            'idContrato' => 'required|integer',
        ];
    
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'unique' => 'El campo :attribute ya ha sido registrado.',
            'digits' => 'El campo :attribute debe tener :digits dígitos.',
            'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
            'min' => [
                'string' => 'El campo :attribute debe tener al menos :min caracteres.',
            ],
            'max' => [
                'string' => 'El campo :attribute debe tener menos de :max caracteres.',
            ],
            'integer' => 'El campo :attribute debe ser un número entero.',
            'idContrato.required' => 'El campo contrato es obligatorio.',
            'regex' => 'El campo :attribute solo puede contener letras.',

        ];
    
        $validatedData = $request->validate($rules, $messages);
    
        $paciente = Paciente::findOrFail($id);
        $paciente->update($validatedData);
    
        return redirect()->route('Paciente.index')
            ->with('success', 'Paciente actualizado correctamente.');
    }
    

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paciente = Paciente::find($id)->delete();

        return redirect()->route('Paciente.index')
            ->with('success', 'Paciente eliminado correctamente');
    }


    public function reactivatePaciente(Request $request)
    {
        $pacienteId = $request->input('pacienteId');
        $contratoId = $request->input('contratoId');

        $paciente = Paciente::find($pacienteId);
        if (!$paciente) {
            return response()->json(['success' => false, 'message' => 'Paciente not found']);
        }
    
        $newPaciente = $paciente->replicate();
    
        $paciente->estado = 2;
        $paciente->correo = 'Desactivado' . rand(1000, 9999) . '@example.com';
        $paciente->save();
    
        $newPaciente->estado = 0;
        $newPaciente->idContrato = $contratoId;
        $newPaciente->save();
    
        return response()->json(['success' => true]);
    }
    
}