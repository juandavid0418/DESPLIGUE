<?php

namespace App\Http\Controllers;

use App\Models\Ep;
use Illuminate\Http\Request;

/**
 * Class EpController
 * @package App\Http\Controllers
 */
class EpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eps = Ep::paginate();

        return view('ep.index', compact('eps'))
            ->with('i', (request()->input('page', 1) - 1) * $eps->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ep = new Ep();
        return view('ep.create', compact('ep'));
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
            'eps' => 'required|min:4',
            'direccion' => 'required|min:10',
            'telefonogeneral' => 'required|digits:10',
            'telefonoprincipal' => 'required|digits:7',
        ];
    
        $messages = [
            'eps.min' => 'La EPS debe tener al menos 4 letras.',
            'direccion.min' => 'La dirección debe tener al menos 10 caracteres.',
            'telefonogeneral.digits' => 'El celular del asesor debe tener 10 números.',
            'telefonoprincipal.digits' => 'El teléfono principal debe tener 7 números.',
            'required' => 'El campo es obligatorio.',
        ];
    
        $validatedData = $request->validate($rules, $messages);
    
        $ep = Ep::create($validatedData);
    
        return redirect()->route('Ep.index')
            ->with('success', 'Eps creada correctamente.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ep = Ep::find($id);

        return view('ep.show', compact('ep'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ep = Ep::find($id);

        return view('ep.edit', compact('ep'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ep $ep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'eps' => 'required|min:4',
            'direccion' => 'required|min:10',
            'telefonogeneral' => 'required|digits:10',
            'telefonoprincipal' => 'required|digits:7',
        ];
    
        $messages = [
            'eps.min' => 'La EPS debe tener al menos 4 letras.',
            'direccion.min' => 'La dirección debe tener al menos 10 caracteres.',
            'telefonogeneral.digits' => 'El celular del asesor debe tener 10 números.',
            'telefonoprincipal.digits' => 'El teléfono principal debe tener 7 números.',
            'required' => 'El campo es obligatorio.',
        ];
        
        $request->validate($rules, $messages);
    
        $ep = Ep::findOrFail($id);
        $ep->update($request->all());
    
        return redirect()->route('Ep.index')
            ->with('success', 'Eps actualizada correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ep = Ep::find($id)->delete();

        return redirect()->route('Ep.index')
            ->with('success', 'Eps eliminada correctamente');
    }
}
