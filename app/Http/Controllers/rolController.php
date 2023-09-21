<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

/**
 * Class RolController
 * @package App\Http\Controllers
 */
class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        {
            $busqueda = $request->busqueda;
            $rols = Rol::where('nombre_rol', 'LIKE', '%' . $busqueda . '%')
                        ->paginate();
        
            return view('rol.index', compact('rols'))
                ->with('i', (request()->input('page', 1) - 1) * $rols->perPage());
        }
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = new Rol();
        return view('rol.create', compact('rol'));
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
            'nombre_rol' => 'required|unique:rols',
        ];        
        $messages = [
            'unique' => 'Este rol ya ha sido registrado.',
             
        ];
        $validatedData = $request->validate($rules, $messages);


        $rol = Rol::create($validatedData);

        return redirect()->route('Rol.index')
            ->with('Exito', 'Rol creado Exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Rol::find($id);

        return view('rol.show', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Rol::find($id);

        return view('rol.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Rol $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nombre_rol' => [
                'required',
                'unique:rols,nombre_rol,' . $id,
                'regex:/^[a-zA-Z\s]{3,}$/'
            ],
        ];
    
        $messages = [
            'nombre_rol.required' => 'Rol es obligatorio.',
            'nombre_rol.unique' => 'No puedes cambiar el nombre de este rol porque ya ha sido registrado.',
            'nombre_rol.regex' => 'El nombre del rol debe contener al menos 3 letras y no puede tener caracteres especiales.',
        ];
    
        $validatedData = $request->validate($rules, $messages);
    
        $rol = Rol::find($id);
        $rol->update($validatedData);
    
        return redirect()->route('Rol.index')
            ->with('success', 'Rol actualizado exitosamente.');
    }
    


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rol = Rol::find($id)->delete();

        return redirect()->route('Rol.index')
            ->with('success', 'Rol deleted successfully');
    }
}