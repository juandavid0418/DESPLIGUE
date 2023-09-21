@extends('layouts.app')

@section('template_title')
    {{ $paciente->name ?? "{{ __('Show') Paciente" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} paciente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Paciente.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $paciente->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido:</strong>
                            {{ $paciente->apellido }}
                        </div>
                        <div class="form-group">
                            <strong>Correo:</strong>
                            {{ $paciente->correo }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $paciente->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $paciente->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Ciudad:</strong>
                            {{ $paciente->ciudad }}
                        </div>
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $paciente->documento }}
                        </div>
                        <div class="form-group">
                            <strong>idContrato:</strong>
                            {{ $paciente->contrato && $paciente->contrato->eps ? $paciente->contrato->eps->eps : 'No asignado' }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
