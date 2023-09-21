<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre Rol') }}
            {{ Form::text('nombre_rol', $rol->nombre_rol, ['class' => 'form-control' . ($errors->has('nombre_rol') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('nombre_rol', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary" style="background-color: #E74C3C; color: white; border-radius: 10px; border-color:#E74C3C; ">{{ __('Guardar') }}</button>
    </div>
</div>