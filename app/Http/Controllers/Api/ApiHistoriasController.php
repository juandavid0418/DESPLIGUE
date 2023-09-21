<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Historia; // Asegúrate de importar el modelo Historia
use Illuminate\Http\Request;

class ApiHistoriasController extends Controller
{
    public function createHistoria(Request $request)
    {
        // Obtener los datos del cuerpo de la solicitud JSON
        $data = $request->all();

        // Crear una nueva instancia de Historia con los datos
        $historia = new Historia($data);

        // Guardar la historia en la base de datos
        $historia->save();

        // Devolver una respuesta JSON con el objeto creado
        return response()->json($historia, 201);
    }

    public function getHistorias(Request $request, $id = null)
    {
        if ($id !== null) {
            // Buscar una historia específica por ID
            $historia = Historia::find($id);
    
            if (!$historia) {
                return response()->json(['message' => 'Historia no encontrada'], 404);
            }
    
            return response()->json($historia);
        } else {
            // Obtener todas las historias si no se proporciona un ID
            $historias = Historia::all();
            return response()->json($historias);
        }
    }
    

    public function updateHistoria(Request $request, $id)
    {
        // Validar los datos recibidos (puedes agregar reglas de validación aquí si es necesario)
        $validatedData = $request->validate([
            // Define las reglas de validación aquí si es necesario
        ]);

        // Buscar la historia por ID
        $historia = Historia::findOrFail($id);

        // Actualizar los atributos del modelo con los datos validados
        $historia->update($validatedData);

        // Devolver una respuesta JSON con el objeto actualizado
        return response()->json($historia);
    }

    public function deleteHistoria($id)
    {
        $historia = Historia::findOrFail($id);

        $historia->delete();

        return response()->json(['message' => 'Historia eliminada correctamente']);
    }
    public function getHistoriasByPacienteId($pacientes_id) {
        $historias = Historia::where('pacientes_id', $pacientes_id)->get();
    
        if (!$historias->isEmpty()) {
            return response()->json($historias, 200);
        } else {
            return response()->json(['message' => 'No se encontró historia para este paciente'], 404);
        }
    }
}

