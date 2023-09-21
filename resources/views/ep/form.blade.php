<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            
            <div class="form-group col-md-6">
                {{ Form::label('Eps') }}
                {{ Form::text('eps', $ep->eps, ['class' => 'form-control' . ($errors->has('eps') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('eps', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Direccion') }}
                {{ Form::text('direccion', $ep->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Teléfono Asesor') }}
                {{ Form::number('telefonogeneral', $ep->telefonogeneral, ['class' => 'form-control' . ($errors->has('telefonogeneral') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('telefonogeneral', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('Teléfono Principal') }}
                {{ Form::number('telefonoprincipal', $ep->telefonoprincipal, ['class' => 'form-control' . ($errors->has('telefonoprincipal') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('telefonoprincipal', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary" style="background-color: #E74C3C; color: white; border-radius: 10px; border-color:#E74C3C; ">{{ __('Guardar') }}</button>
    </div>
</div>
