

<div class="box box-info padding-1">
    <div class="box-body">
    @if(empty($agenda->id))

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Contrato') }}
                    {{ Form::select('idContrato', $contrato, null, ['id' => 'idContrato', 'class' => 'form-control' . ($errors->has('idContrato') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un contrato']) }}
                    {!! $errors->first('idContrato', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Enfermer@') }}
                    {{ Form::select('id_user', [], null, ['id' => 'idEnfermera', 'class' => 'form-control' . ($errors->has('id_user') ? ' is-invalid' : ''), 'placeholder' => 'Enfermer@']) }}
                    {!! $errors->first('id_user', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Paciente') }}
                    {{ Form::select('id_pacientes', [], null, ['id' => 'idPaciente', 'class' => 'form-control' . ($errors->has('id_pacientes') ? ' is-invalid' : ''), 'placeholder' => 'Pacientes']) }}
                    {!! $errors->first('id_pacientes', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('fecha_inicio') }}
                    {{ Form::date('fecha_inicio', $agenda->fecha_inicio, ['id' => 'fecha_inicio', 'class' => 'form-control' . ($errors->has('fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Inicio']) }}
                    {!! $errors->first('fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Fecha Fin') }}
                {{ Form::date('fecha_fin', $agenda->fecha_fin, [
                    'id' => 'fecha_fin',
                    'class' => 'form-control' . ($errors->has('fecha_fin') ? ' is-invalid' : ''),
                    'placeholder' => '',
                    'min' => now()->format('Y-m-d'), // Establece la fecha mínima como la fecha actual
                    'required' => 'required' // Para requerir la entrada de fecha
                ]) }}
                {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('hora') }}
                    {{ Form::time('hora', $agenda->hora, ['id' => 'hora_inicio', 'class' => 'form-control' . ($errors->has('hora') ? ' is-invalid' : ''), 'placeholder' => 'Hora']) }}
                    {!! $errors->first('hora', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('hora_fin') }}
                    {{ Form::time('hora_fin', $agenda->hora_fin, ['id' => 'hora_fin', 'class' => 'form-control' . ($errors->has('hora_fin') ? ' is-invalid' : ''), 'placeholder' => 'Hora Fin']) }}
                    {!! $errors->first('hora_fin', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
         <button type="submit" class="btn btn-primary" style="background-color: #E74C3C; color: white; border-radius: 10px; border-color:#E74C3C; " onclick="return confirm('¿Estás seguro de que deseas confirmar esta agenda?')">{{ __('Guardar') }}
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const horaInicioInput = document.getElementById('hora_inicio');
    const horaFinInput = document.getElementById('hora_fin');

    horaInicioInput.addEventListener('change', function() {
        const horaInicio = new Date(`1970-01-01T${this.value}:00`); // Ajustar fecha para manipulación
        horaInicio.setHours(horaInicio.getHours() + 8); // Agrega 8 horas

        let horas = horaInicio.getHours().toString().padStart(2, '0');  // Para tener formato HH
        let minutos = horaInicio.getMinutes().toString().padStart(2, '0');  // Para tener formato MM

        horaFinInput.min = `${horas}:${minutos}`;
        horaFinInput.value = horaFinInput.min; // Setea la hora fin a 8 horas después de la hora inicio por defecto

        // Establecer el campo de hora de finalización solo de lectura
        horaFinInput.readOnly = true;
    });

    // Si deseas permitir que el usuario cambie la hora de inicio y, por lo tanto, restablecer la hora de finalización
    horaInicioInput.addEventListener('click', function() {
        horaFinInput.readOnly = false;
        horaFinInput.value = ''; // Borra el valor anterior
    });
});

    
document.getElementById('fecha_inicio').onchange = function() {
    document.getElementById('fecha_fin').min = this.value;
};

document.getElementById('hora').onchange = function() {
     document.getElementById('fecha_inicio').value === document.getElementById('fecha_fin').value
};


</script>
<script>
// Obtener elementos del DOM
const idContratoSelect = document.getElementById('idContrato');
const idPacienteSelect = document.getElementById('idPaciente');
const idEnfermeraSelect = document.getElementById('idEnfermera');
const fechaInicioInput = document.getElementById('fecha_inicio');
const fechaFinInput = document.getElementById('fecha_fin');

// Suponiendo que usas Blade para obtener los valores actuales de la edición
const pacienteIdActual = '{{ $agenda->id_pacientes }}';
const usuarioIdActual = '{{ $agenda->id_user }}';

// Manejar el evento change del contrato
idContratoSelect.addEventListener('change', function () {
    const selectedContratoId = this.value;

    fetch(`/contratos/obtener-datos?contratoId=${selectedContratoId}`)
        .then(response => response.json())
        .then(data => {
            // Llenar los campos de selección de paciente y usuario con los datos obtenidos
            idPacienteSelect.innerHTML = '<option value="">Selecciona un paciente</option>';
            idEnfermeraSelect.innerHTML = '<option value="">Selecciona una enfermer@</option>';

            data.pacientes.forEach(paciente => {
                const option = document.createElement('option');
                option.value = paciente.id;
                option.textContent = paciente.nombre;
                idPacienteSelect.appendChild(option);
            });

            data.usuarios.forEach(usuario => {
                const option = document.createElement('option');
                option.value = usuario.id;
                option.textContent = usuario.name;
                idEnfermeraSelect.appendChild(option);
            });

            // Configurar las fechas de inicio y fin de acuerdo al contrato seleccionado
            fechaInicioInput.min = data.contrato.fecha_inicio;
            fechaInicioInput.max = data.contrato.fecha_fin;
            fechaFinInput.min = data.contrato.fecha_inicio;
            fechaFinInput.max = data.contrato.fecha_fin;

            // Después de poblar los selects, seleccionamos el valor correcto si estamos en modo edición
            if (pacienteIdActual) {
                idPacienteSelect.value = pacienteIdActual;
            }
            if (usuarioIdActual) {
                idEnfermeraSelect.value = usuarioIdActual;
            }
        })
        .catch(error => console.error(error));
});

// Si el contrato ya está seleccionado al cargar la página, dispara el evento "change"
if (idContratoSelect.value) {
    idContratoSelect.dispatchEvent(new Event('change'));
}

</script>