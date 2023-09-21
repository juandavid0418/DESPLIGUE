<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda; // Asegúrate de importar el modelo Agenda
use Illuminate\Http\Request;

class ApiAgendaController extends Controller
{
    public function createAgenda(Request $request)
    {
        // Obtener los datos del cuerpo de la solicitud JSON
        $data = $request->all();

        // Crear una nueva instancia de Agenda con los datos
        $agenda = new Agenda($data);

        // Guardar la agenda en la base de datos
        $agenda->save();

        // Devolver una respuesta JSON con el objeto creado
        return response()->json($agenda, 201);
    }


    public function getAgenda(Request $request, $id = null)
    {
        if ($id !== null) {
            // Buscar una agenda específica por ID
            $agenda = Agenda::find($id);
    
            if (!$agenda) {
                return response()->json(['message' => 'Agenda no encontrada'], 404);
            }
    
            return response()->json($agenda);
        } else {
            // Obtener todas las agendas si no se proporciona un ID
            $agendas = Agenda::all();
            return response()->json($agendas);
        }
    }
    

    

    public function updateAgenda(Request $request, $id)
    {
        // Validar los datos recibidos (puedes agregar reglas de validación aquí si es necesario)
        $validatedData = $request->validate([
            // Define las reglas de validación aquí si es necesario
        ]);

        // Buscar la agenda por ID
        $agenda = Agenda::findOrFail($id);

        // Actualizar los atributos del modelo con los datos validados
        $agenda->update($validatedData);

        // Devolver una respuesta JSON con el objeto actualizado
        return response()->json($agenda);
    }


    public function deleteAgenda($id)

{
    $agenda = Agenda::findOrFail($id);

    $agenda->delete();

    return response()->json(['message' => 'Agenda eliminada correctamente']);
}

public function getAgendasByContractId($idContrato) {
    try {
        $agendas = Agenda::where('idContrato', $idContrato)->get();  // Asumiendo que tienes un modelo llamado "Agenda"
        
        return response()->json($agendas, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al obtener las agendas.'], 500);
    }
}

public function getAgendasByUserId($userId) {
    $agendas = Agenda::where('id_user', $userId)->get();  // Asume que el campo en la tabla agenda para el ID de usuario es 'id_user'
    return response()->json($agendas);
}



}
