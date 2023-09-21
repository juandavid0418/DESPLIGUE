@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Roles Permiso
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Roles Permiso</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles-permisos.update', $rolesPermiso->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('roles-permiso.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
