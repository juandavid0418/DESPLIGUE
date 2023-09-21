@extends('layouts.app')

@section('template_title')
    {{ $rolesPermiso->name ?? "{{ __('Show') Roles Permiso" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Roles Permiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('roles-permisos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Idrol:</strong>
                            {{ $rolesPermiso->IdRol }}
                        </div>
                        <div class="form-group">
                            <strong>Idpermisos:</strong>
                            {{ $rolesPermiso->IdPermisos }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
