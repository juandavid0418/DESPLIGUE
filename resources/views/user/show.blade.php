@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? "{{ __('Show') User" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} usuario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('User.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido:</strong>
                            {{ $user->apellido }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $user->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $user->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Ciudad:</strong>
                            {{ $user->ciudad }}
                        </div>
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $user->cedula }}
                        </div>

                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de registro:</strong>
                            {{ $user->created_at }}
                        </div>
                        <div class="form-group">
                            <strong>Eps:</strong>
                            {{ $user->idContrato }}
                        </div>
                        <div class="form-group">
                            <strong>Zona:</strong>
                            {{ $user->zona }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection