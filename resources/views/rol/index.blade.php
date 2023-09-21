@extends('layouts.app')

@section('template_title')
    Rol
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <h3>{{ __('Roles') }}</h3>
                            </span>

                            <div class="d-md-flex justify-content-md-end">
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rols as $rol)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $rol->nombre_rol }}</td>
                                            <td>
                                                <form action="{{ route('Rol.destroy',$rol->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-warning" href="{{ route('Rol.edit',$rol->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $rols->links() !!}
            </div>
        </div>
    </div>
@endsection