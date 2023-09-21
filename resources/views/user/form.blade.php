<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Nombre') }}
                    {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Apellido') }}
                    {{ Form::text('apellido', $user->apellido, ['class' => 'form-control' . ($errors->has('apellido') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('apellido', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Teléfono') }}
                    {{ Form::text('telefono', $user->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Dirección') }}
                    {{ Form::text('direccion', $user->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Ciudad') }}
                    {{ Form::text('ciudad', $user->ciudad, ['class' => 'form-control' . ($errors->has('ciudad') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('ciudad', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Cedula') }}
                    {{ Form::text('cedula', $user->cedula, ['class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('cedula', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Correo') }}
                    {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Contraseña') }}
                    {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Rol') }}
                    {{ Form::select('IdRol', $rol, 1, ['class' => 'form-control' . ($errors->has('IdRol') ? ' is-invalid' : ''), 'placeholder' => 'IdRol', 'id' => 'IdRol']) }}
                    {!! $errors->first('IdRol', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
            <div id="contrato-form" style="display: none;">
            <div class="form-group">
                {{ Form::label('Contrato') }}
                {{ Form::select('idContrato', $contrato, null, ['class' => 'form-control' . ($errors->has('idContrato') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un contrato']) }}
                {!! $errors->first('idContrato', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <div id="zona-form" style="display: none;">
                    <div class="form-group">
                        {{ Form::label('zona') }}
                        {{ Form::select('zona', ['Sur' => 'Sur', 'Norte' => 'Norte', 'Central' => 'Central'], $user->zona, ['class' => 'form-control' . ($errors->has('zona') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona una zona']) }}
                        {!! $errors->first('zona', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script>
        function checkRoleSelection() {
            var selectedRole = document.getElementById('IdRol').value;
            var contratoForm = document.getElementById('contrato-form');
            var zonaForm = document.getElementById('zona-form');
            
            if (selectedRole === '2') {
                contratoForm.style.display = 'block';
                zonaForm.style.display = 'block';
            } else {
                contratoForm.style.display = 'none';
                zonaForm.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            checkRoleSelection();
        });

        document.getElementById('IdRol').addEventListener('change', checkRoleSelection);

        </script>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary" style="background-color: #E74C3C; color: white; border-radius: 10px; border-color:#E74C3C; ">{{ __('Guardar') }}</button>
    </div>
</div>
