<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('IdRol') }}
            {{ Form::text('IdRol', $rolesPermiso->IdRol, ['class' => 'form-control' . ($errors->has('IdRol') ? ' is-invalid' : ''), 'placeholder' => 'Idrol']) }}
            {!! $errors->first('IdRol', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('IdPermisos') }}
            {{ Form::text('IdPermisos', $rolesPermiso->IdPermisos, ['class' => 'form-control' . ($errors->has('IdPermisos') ? ' is-invalid' : ''), 'placeholder' => 'Idpermisos']) }}
            {!! $errors->first('IdPermisos', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary" style="background-color: #E74C3C; color: white; border-radius: 10px; border-color:#E74C3C; ">{{ __('Submit') }}</button>
    </div>
</div>