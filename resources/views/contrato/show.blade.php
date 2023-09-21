@extends('layouts.app')

@section('template_title')
    {{ $contrato->name ?? "{{ __('Show') Contrato" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} contrato</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Contrato.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ideps:</strong>
                            {{ $contrato->idEps }}
                        </div>
                        <div class="form-group">
                            <strong>Costo:</strong>
                            {{ $contrato->costo }}
                        </div>
                        <div class="form-group">
                            <strong>Politicas:</strong>
                            {{ $contrato->politicas }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection