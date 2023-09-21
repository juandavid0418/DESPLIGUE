@extends('layouts.app')

@section('template_title')
    {{ $agenda->name ?? "{{ __('Show') Agenda" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Agenda</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Agenda.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha Inicio:</strong>
                            {{ $agenda->fecha_inicio }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Fin</strong>
                            {{ $agenda->fecha_fin }}
                        </div>
                        <div class="form-group">
                            <strong>Hora Inicio:</strong>
                            {{ $agenda->hora }}
                        </div>
                        <div class="form-group">
                            <strong>Hora Fin:</strong>
                            {{ $agenda->hora_fin }}
                        </div>
                        <div class="form-group">
                            <strong>Id Pacientes:</strong>
                            {{ $agenda->paciente->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Enfermera:</strong>
                            {{ $agenda->usuario->name }}
                        </div>
                        <div class="form-group">
                            <strong>Contrato:</strong>
                            {{ $agenda->contrato ? ($agenda->contrato->eps ? $agenda->contrato->eps->eps . ' - ' . $agenda->contrato->Nro_contrato : 'EPS no asignada') : 'Contrato no asignado' }}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
