<?php

namespace App\Http\Controllers;
use App\Models\Contrato;
use App\Models\User;
use App\Models\Rol;
use App\Models\Ep;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Barryvdh\DomPDF\Facade\Pdf;



class UserController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/User';

   
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $users = User::where('cedula', $busqueda)
            ->orWhere('created_at', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('name', 'LIKE', '%' . $busqueda . '%')
            ->latest('id')
            ->paginate();
            $contrato = Contrato::where('estado', 0)
            ->join('eps', 'contratos.idEps', '=', 'eps.id')
            ->selectRaw("concat(eps.eps, ' - ', contratos.Nro_contrato) as eps_contrato, contratos.id")
            ->pluck('eps_contrato', 'contratos.id');

    
        $totalUsers = User::count();
        
        return view('User.index', compact('users', 'totalUsers', 'contrato'))
        ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

   
    public function pdf(){

        $user=User::all();
        $pdf = Pdf::loadView('User.pdf', compact('user'));
        return $pdf->stream();

    }

    public function create()
    {
        $user = new User();
        $rol = Rol::pluck('nombre_rol', 'id');
        $contrato = Contrato::where('estado', 0)
        ->join('eps', 'contratos.idEps', '=', 'eps.id')
        ->selectRaw("concat(eps.eps, ' - ', contratos.Nro_contrato) as eps_contrato, contratos.id")
        ->pluck('eps_contrato', 'contratos.id');    
        $eps = Ep::pluck('eps','id');
        return view('User.create', compact('user', 'rol','contrato','eps'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30', 'min:3', 'regex:/^[A-Za-z]+$/'],
            'apellido' => ['required', 'string', 'max:30', 'min:5', 'regex:/^[A-Za-z]+$/'],
            'telefono' => ['required', 'integer', 'digits:10'],
            'direccion' => ['required', 'string', 'max:50', 'min:5'],
            'ciudad' => ['required', 'string', 'regex:/^[A-Za-z]+$/'],
            'cedula' => ['required', 'string', 'digits_between:7,10'],
            'email' => ['required', 'email', 'unique:users'],
            'estado' => 0,
            'password' => ['required', 'string', 'min:8'],
            'IdRol' => ['required', 'integer'],
            'idContrato' => ['required', 'integer'],
            'zona' => ['required', 'string', 'regex:/^[A-Za-z]+$/'],


        ]);
    }

    protected function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'ciudad' => $data['ciudad'],
            'cedula' => $data['cedula'],
            'email' => $data['email'],
            'estado' => 0,
            'password' => Hash::make($data['password']),
            'IdRol' => $data['IdRol'],
            'idContrato' => $data['idContrato'], 
            'ejecucion' => 0,
            'zona' => $data['zona']

        ]);
    }

    public function store(Request $request)
    {
       
        $rules = [
            'name' => ['required', 'string', 'max:30', 'min:3', 'regex:/^[A-Za-z ]+$/'],
            'apellido' => ['required', 'string', 'max:30', 'min:5', 'regex:/^[A-Za-z ]+$/'],
            'telefono' => ['required', 'integer', 'digits:10'],
            'direccion' => ['required', 'string', 'max:50', 'min:10'],
            'ciudad' => ['required', 'string', 'max:30', 'min:4','regex:/^[A-Za-z ]+$/'],
            'cedula' => ['required', 'string', 'digits_between:7,10'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'IdRol' => ['required', 'integer'],
            'idContrato' => ['nullable', 'integer'],
            'zona' => ['nullable', 'string', 'regex:/^[A-Za-z ]+$/'],
            'idContrato' => ['nullable', 'integer'],
            'zona' => ['nullable', 'string', 'regex:/^[A-Za-z ]+$/'],
            'zona' => ['nullable', 'string', 'regex:/^[A-Za-z ]+$/'],
            'ejecucion' => ['default:0'],


        ];
        
        if($request->input('IdRol') == 2) {
            $rules['idContrato'] = 'required';
            $rules['zona'] = 'required|string|regex:/^[A-Za-z ]+$/';
        }
    

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
                'string' => 'El campo :attribute debe tener máximo :max caracteres.',
            ],
            'integer' => 'El campo :attribute debe ser un número entero.',
            'regex' => 'El campo :attribute solo puede contener letras.',
            'IdRol.required' => 'El campo ID de rol es obligatorio.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = User::create([
            'name' => $validatedData['name'],
            'apellido' => $validatedData['apellido'],
            'telefono' => $validatedData['telefono'],
            'direccion' => $validatedData['direccion'],
            'ciudad' => $validatedData['ciudad'],
            'cedula' => $validatedData['cedula'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'IdRol' => $validatedData['IdRol'],
            'idContrato' => $validatedData['idContrato'],
            'ejecucion' => 0,
            'zona' => $validatedData['zona'],


        ]);

        return redirect()->route('User.index')
            ->with('success', 'Usuario creado correctamente.');
          
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('User.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $rol = Rol::pluck('nombre_rol', 'id');
        $contrato = Contrato::where('estado', 0)
        ->join('eps', 'contratos.idEps', '=', 'eps.id')
        ->selectRaw("concat(eps.eps, ' - ', contratos.Nro_contrato) as eps_contrato, contratos.id")
        ->pluck('eps_contrato', 'contratos.id');    
        $eps = Ep::pluck('eps','id');
        return view('user.edit', compact('user', 'rol','contrato','eps'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => ['required', 'string', 'max:30', 'min:3', 'regex:/^[A-Za-z ]+$/'],
            'apellido' => ['required', 'string', 'max:30', 'min:5', 'regex:/^[A-Za-z ]+$/'],
            'telefono' => ['required', 'digits:10'],
            'direccion' => ['required', 'string', 'max:50', 'min:15'],
            'ciudad' => ['required', 'string', 'regex:/^[A-Za-z ]+$/'],
            'cedula' => ['required', 'digits_between:7,10'],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'password' => ['nullable', 'string', 'min:8'],
            'IdRol' => ['required', 'integer'],
            'idContrato' => ['nullable', 'integer'],
            'zona' => ['nullable', 'string', 'regex:/^[A-Za-z ]+$/'],
            'ejecucion' => ['default:0'],

        ];

        if($request->input('IdRol') == 2) {
            $rules['idContrato'] = 'required';
            $rules['zona'] = 'required';
        }
        
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
                'string' => 'El campo :attribute debe tener máximo :max caracteres.',
            ],
            'integer' => 'El campo :attribute debe ser un número entero.',
            'regex' => 'El campo :attribute solo puede contener letras.',
            'IdRol.required' => 'El campo ID de rol es obligatorio.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = User::find($id);
        $user->name = $validatedData['name'];
        $user->apellido = $validatedData['apellido'];
        $user->telefono = $validatedData['telefono'];
        $user->direccion = $validatedData['direccion'];
        $user->ciudad = $validatedData['ciudad'];
        $user->cedula = $validatedData['cedula'];
        $user->email = $validatedData['email'];
        $user->IdRol = $validatedData['IdRol'];
        $user->idContrato = $validatedData['idContrato'];
        $user->zona = $validatedData['zona'];

        // Verificar si se proporcionó una nueva contraseña
        if (!empty($validatedData['password'])) {
            // Encriptar la nueva contraseña
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('User.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('User.index')
            ->with('success', 'User eliminado correctamente');
    }

    public function reactivateUser(Request $request)
{
    $userId = $request->input('userId');
    $contratoId = $request->input('contratoId');
    
    $user = User::find($userId);
    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not found']);
    }
    
    $newUser = $user->replicate();

    $user->estado = 2;
    $user->email = 'Desactivado' . rand(1000, 9999) . '@example.com';
    $user->password = "Desactivado";
    $user->save();

    $newUser->estado = 0;
    $newUser->idContrato = $contratoId;
    $newUser->save();

    return response()->json(['success' => true]);
}


}
