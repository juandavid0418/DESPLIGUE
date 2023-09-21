<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
        <div class="form-group col-md-6">
                {{ Form::label('Contrato') }}
                {{ Form::select('idContrato', $contrato, $paciente->idContrato, ['class' => 'form-control' . ($errors->has('idContrato') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('idContrato', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Nombre') }}
                {{ Form::text('nombre', $paciente->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Apellido') }}
                {{ Form::text('apellido', $paciente->apellido, ['class' => 'form-control' . ($errors->has('apellido') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('apellido', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Correo') }}
                {{ Form::text('correo', $paciente->correo, ['class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Teléfono') }}
                {{ Form::text('telefono', $paciente->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Dirección') }}
                {{ Form::text('direccion', $paciente->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Ciudad') }}
                {{ Form::text('ciudad', $paciente->ciudad, ['class' => 'form-control' . ($errors->has('ciudad') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('ciudad', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Documento') }}
                {{ Form::text('documento', $paciente->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary" style="background-color: #E74C3C; color: white; border-radius: 10px; border-color:#E74C3C; ">{{ __('Guardar') }}</button>
    </div>
</div>
