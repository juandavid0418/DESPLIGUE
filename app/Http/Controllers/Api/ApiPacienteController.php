<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente; // Asegúrate de importar el modelo Paciente
use Illuminate\Http\Request;

class ApiPacienteController extends Controller
{
    public function createPaciente(Request $request)
    {
        // Obtener los datos del cuerpo de la solicitud JSON
        $data = $request->all();

        // Crear una nueva instancia de Paciente con los datos
        $paciente = new Paciente($data);

        // Guardar el paciente en la base de datos
        $paciente->save();

        // Devolver una respuesta JSON con el objeto creado
        return response()->json($paciente, 201);
    }

    public function getPacientes(Request $request, $id = null)
    {
        if ($id !== null) {
            // Buscar un paciente específico por ID
            $paciente = Paciente::find($id);
    
            if (!$paciente) {
                return response()->json(['message' => 'Paciente no encontrado'], 404);
            }
    
            return response()->json($paciente);
        } else {
            // Obtener todos los pacientes si no se proporciona un ID
            $pacientes = Paciente::all();
            return response()->json($pacientes);
        }
    }
    

    public function updatePaciente(Request $request, $id)
    {
        // Validar los datos recibidos (puedes agregar reglas de validación aquí si es necesario)
        $validatedData = $request->validate([
            // Define las reglas de validación aquí si es necesario
        ]);

        // Buscar el paciente por ID
        $paciente = Paciente::findOrFail($id);

        // Actualizar los atributos del modelo con los datos validados
        $paciente->update($validatedData);

        // Devolver una respuesta JSON con el objeto actualizado
        return response()->json($paciente);
    }

    public function deletePaciente($id)
    {
        $paciente = Paciente::findOrFail($id);

        $paciente->delete();

        return response()->json(['message' => 'Paciente eliminado correctamente']);
    }
}
