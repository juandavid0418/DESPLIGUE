@extends('layouts.app')

@section('template_title')
    Historia
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} historia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Historia.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                    <div class="form-group">
                            <strong>Paciente :</strong>
                            {{ $historia->paciente->nombre }}

                        </div>
                        <div class="form-group">
                            <strong>Antecedentes :</strong>
                            {{ $historia->antecedentesalergicos }}

                        </div>
                        <div class="form-group">
                            <strong>Evolución :</strong>
                            {{ $historia->evolucion }}

                        </div>
                        
                        <div class="form-group">
                            <strong>Diagnostico:</strong>
                            {{ $historia->diagnostico }}
                        </div>
                        <div class="form-group">
                            <strong>Signos vitales:</strong>
                            {{ $historia->signosvitales }}
                        </div>
                        <div class="form-group">
                            <strong>Tratamiento:</strong>
                            {{ $historia->tratamiento }}
                        </div>
                      

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
