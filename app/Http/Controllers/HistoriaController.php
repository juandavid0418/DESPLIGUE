<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use Illuminate\Http\Request;
use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;



/**
 * Class HistoriaController
 * @package App\Http\Controllers
 */
class HistoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historias = Historia::paginate();

        return view('historia.index', compact('historias'))
            ->with('i', (request()->input('page', 1) - 1) * $historias->perPage());
    }

    public function pdf(){

        $historias=Historia::all();
        $pdf = Pdf::loadView('Historia.pdf', compact('historias'));
        return $pdf->stream();

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $historia = new Historia();
        $pacientes = Paciente::pluck('nombre','id');

        return view('historia.create', compact('historia','pacientes'));
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
        'diagnostico' => 'required',
        'signosvitales' => 'required',
        'antecedentesalergicos' => 'required',
        'evolucion' => 'required',
        'tratamiento' => 'required',
        'pacientes_id' => 'required',
    ];

    $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    $validatedData = $request->validate($rules, $messages);

    $historia = Historia::create($validatedData);

    return redirect()->route('Historia.index')
        ->with('success', 'Historia creada correctamente.');
}

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historia = Historia::find($id);

        return view('historia.show', compact('historia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $historia = Historia::find($id);
        $pacientes = Paciente::pluck('nombre','id');
        return view('historia.edit', compact('historia','pacientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Historia $historia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $rules = [
        'diagnostico' => 'required',
        'signosvitales' => 'required',
        'antecedentesalergicos' => 'required',
        'evolucion' => 'required',
        'tratamiento' => 'required',
        'pacientes_id' => 'required',
    ];

    $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    $validatedData = $request->validate($rules, $messages);

    $historia = Historia::findOrFail($id);
    $historia->update($validatedData);

    return redirect()->route('Historia.index')
        ->with('success', 'Historia actualizada correctamente.');
}
    
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $historia = Historia::find($id)->delete();

        return redirect()->route('Historia.index')
            ->with('success', 'Historia eliminada correctamente');
    }


    
}
