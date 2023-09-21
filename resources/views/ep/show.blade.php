@extends('layouts.app')

@section('template_title')
    {{ $ep->name ?? "{{ __('Show') Ep" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} eps</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Ep.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $ep->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
