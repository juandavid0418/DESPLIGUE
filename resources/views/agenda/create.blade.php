@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Agenda
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Agregar') }} Agenda</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('Agenda.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('agenda.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
