@extends('layouts.app')

@section('template_title')
    User
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">

                            <span id="card_title">
                                <h3>{{ __('Usuario') }}</h3>
                            </span>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="activos-tab" data-toggle="tab" href="#activos-users" aria-controls="activos-users" aria-selected="true">Activos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="inactivos-tab" data-toggle="tab" href="#inactivos-users" aria-controls="inactivos-users" aria-selected="false">Inactivos</a>
                                </li>
                            </ul>
                            <div class="float-right">
                    <a href="{{ route('User.pdf') }}" class="btn btn-primary btn-sm ml-2" data-placement="left" target="_blank">
        {{ __('Informe') }}
    </a>
    <a href="{{ route('User.create') }}" class="btn btn-success btn-sm" data-placement="left">
        {{ __('Nuevo Usuario') }}
    </a>
    
</div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="activos-users" aria-labelledby="activos-tab">
                            <div class="card-body">
                        <div class="table-responsive">
                            <table id="usuarios_table" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Documento</th>
                              
                                        
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users->where('estado', 0) as $user)

                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->telefono }}</td>
                                            <td>{{ $user->direccion }}</td>
                                            <td>{{ $user->cedula }}</td>
                                

                                            <td>
                                                <form action="{{ route('User.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('User.show', $user->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('') }}
                                                    </a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('User.edit', $user->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('') }}
                                                    </a>
                                                    @csrf
                                              
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                            </div>
                            <div class="tab-pane fade" id="inactivos-users" aria-labelledby="inactivos-tab">
                            <div class="card-body">
                        <div class="table-responsive">
                            <table id="usuarios_table" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Documento</th>
                              
                                        
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users->where('estado', 1) as $user)

                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->telefono }}</td>
                                            <td>{{ $user->direccion }}</td>
                                            <td>{{ $user->cedula }}</td>
                                

                                            <td>
                                                    <a class="btn btn-sm btn-primary" href="{{ route('User.show', $user->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('') }}
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-info reactivar-btn" data-toggle="modal" data-target="#reactivarModal" data-id="{{ $user->id }}">
                                                        <i class="fa fa-fw fa-refresh"></i> Reactivar
                                                    </a>
                                                    <div class="modal fade" id="reactivarModal" tabindex="-1" role="dialog" aria-labelledby="reactivarModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="reactivarModalLabel">Seleccionar Contrato</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                            {{ Form::label('Contrato') }}
                                                                    {{ Form::select('idContrato', $contrato, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un contrato']) }}
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <button type="button" class="btn btn-primary" id="saveReactivation">Guardar</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    @csrf

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! $users->links() !!}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    let selectedUserId;

    $('.reactivar-btn').on('click', function() {
        selectedUserId = $(this).data('id');
        $('#reactivarModal').modal('show');
    });

    $('#saveReactivation').click(function() {
        var selectedContract = $('#reactivarModal select[name="idContrato"]').val();
        if (selectedContract) {
            $.post("/reactivateUser", {
                userId: selectedUserId,
                contratoId: selectedContract,
            }, function(data) {
                if (data.success) {
                    alert('Usuario reactivado con éxito.');
                    location.reload();
                } else {
                    alert('Error al reactivar el usuario.');
                }
            });
        } else {
            alert('Por favor, selecciona un contrato.');
        }
    });
});

</script>

@endsection