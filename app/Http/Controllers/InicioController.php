<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Contrato;

class InicioController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPacientes = Paciente::count();
        $totalContratos = Contrato::count();

        return view('inicio', compact('totalUsers', 'totalPacientes','totalContratos'));
    }
}
