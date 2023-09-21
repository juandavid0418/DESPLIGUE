    <style>
    .hidden-checkbox {
        display: none;
    }

    .btn {
        display: inline-block;
        background-color: #2196F3;
        color: white;
        padding: 10px 20px;
        cursor: pointer;
    }

    .alert-container {
        display: none;
        position: fixed;
        top: 10%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
    }

    .alert {
        background-color: #f44336;
        color: white;
        padding: 14px 20px;
        border-radius: 4px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .alert-content {
        padding-right: 30px;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-weight: bold;
        background-color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 20px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        color: black;
    }

    .hidden-checkbox:checked + .btn + .alert-container {
        display: block;
    }


    </style>
<style>
    .hidden-checkbox {
        display: none;
    }
    .btn {
        display: inline-block;
        background-color: #2196F3;
        color: white;
        padding: 10px 20px;
        cursor: pointer;
    }
    .alert-container {
        display: none;
        position: fixed;
        top: 10%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
    }
    .alert {
        background-color: #f44336;
        color: white;
        padding: 14px 20px;
        border-radius: 4px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        position: relative;
    }
    .alert-content {
        padding-right: 30px;
    }
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-weight: bold;
        background-color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 20px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        color: black;
    }
    .hidden-checkbox:checked + .btn + .alert-container {
        display: block;
    }
</style>

@extends('layouts.app')

@section('template_title')
    Contrato
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
                            <h3>{{ __('Contrato') }}</h3>
                        </span>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="activos-tab" data-toggle="tab" href="#activos" aria-controls="activos" aria-selected="true">Activos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="inactivos-tab" data-toggle="tab" href="#inactivos" aria-controls="inactivos" aria-selected="false">Inactivos</a>
                            </li>
                        </ul>
                        <div class="float-right">
                            <a href="{{ route('Contrato.pdf') }}" class="btn btn-primary btn-sm ml-2" data-placement="left" target="_blank">
                                {{ __('Informe') }}
                            </a>
                            <a href="{{ route('Contrato.create') }}" class="btn btn-success btn-sm" data-placement="left">
                                {{ __('Nuevo contrato') }}
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
                        <div class="tab-pane fade show active" id="activos" aria-labelledby="activos-tab">
                            <div class="table-responsive">
                                <table id="contrato_table_activos" class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nro.Contrato</th>
                                            <th>Eps</th>
                                            <th>Fecha Inicio Contrato</th>
                                            <th>Fecha Fin Contrato</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contratos->where('estado', 0) as $contrato)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $contrato->Nro_Contrato }}</td>
                                            <td>{{ $contrato->ep->eps }}</td>
                                            <td>{{ $contrato->fecha_inicio }}</td>
                                            <td>{{ $contrato->fecha_fin }}</td>
                                            <td>
                                                @if ($contrato->estado == 0)
                                                <form action="{{ route('Contrato.toggleEstado', $contrato->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#cancelModal{{ $contrato->id }}">Activo</button>
                                                    <div class="modal fade" id="cancelModal{{ $contrato->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel{{ $contrato->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="cancelModalLabel{{ $contrato->id }}">Cancelar Contrato</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('Contrato.toggleEstado', $contrato->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="razon_cancelacion">Razón de la Cancelación</label>
                                                                            <textarea class="form-control" id="reason" name="razon_cancelacion" rows="3" required></textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-danger">Confirmar Cancelación</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewModal{{ $contrato->id }}"><i class="fa fa-fw fa-eye"></i></a>
                                                <div class="modal fade" id="viewModal{{ $contrato->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $contrato->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewModalLabel{{ $contrato->id }}">Detalles del Contrato</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Pacientes Asociados:</h6>
                                                                <ul>
                                                                    @foreach($contrato->pacientes as $paciente)
                                                                    <li>{{ $paciente->nombre}}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <h6>Usuarios Asociados:</h6>
                                                                <ul>
                                                                    @foreach($contrato->usuarios as $usuario)
                                                                    <li>{{ $usuario->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($contrato->estado == 0)
                                                <a class="btn btn-sm btn-warning" href="{{ route('Contrato.edit', $contrato->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="inactivos" aria-labelledby="inactivos-tab">
                            <div class="table-responsive">
                                <table id="contrato_table_inactivos" class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nro.Contrato</th>
                                            <th>Eps</th>
                                            <th>Fecha Inicio Contrato</th>
                                            <th>Fecha Fin Contrato</th>
                                            <th>Detalles</th>
                                            <th>Motivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contratos->where('estado', 1) as $contrato)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $contrato->Nro_Contrato }}</td>
                                            <td>{{ $contrato->ep->eps }}</td>
                                            <td>{{ $contrato->fecha_inicio }}</td>
                                            <td>{{ $contrato->fecha_fin }}</td>
                                            <td>
                                                @if($contrato->estado == 1)
                                                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewModal{{ $contrato->id }}"><i class="fa fa-fw fa-eye"></i></a>
                                                <div class="modal fade" id="viewModal{{ $contrato->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $contrato->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewModalLabel{{ $contrato->id }}">Detalles del Contrato</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Pacientes Asociados:</h6>
                                                                <ul>
                                                                    @foreach($contrato->pacientes as $paciente)
                                                                    <li>{{ $paciente->nombre}}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <h6>Usuarios Asociados:</h6>
                                                                <ul>
                                                                    @foreach($contrato->usuarios as $usuario)
                                                                    <li>{{ $usuario->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($contrato->estado == 1)
                                                <input type="radio" name="alert-toggle-group" id="alert-toggle-{{ $contrato->id }}" class="hidden-checkbox">
                                                <label for="alert-toggle-{{ $contrato->id }}" class="btn btn-warning">Mostrar Motivo</label>
                                                <div class="alert-container">
                                                    <div class="alert" id="my-alert-{{ $contrato->id }}">
                                                        <div class="alert-content">
                                                            <div class="form-group">
                                                                {{ $contrato->razon_cancelacion }}
                                                            </div>
                                                        </div>
                                                        <label class="close-btn" onclick="closeAlert('{{ $contrato->id }}')">X</label>
                                                    </div>
                                                </div>
                                                @endif
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
            {!! $contratos->links() !!}
        </div>
    </div>
</div>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('js/Spanish.json') }}"></script>
        <script>
            $(document).ready(function () {
                $('#contrato_table_activos').DataTable({
                    "language": {
                        "url": "{{ asset('js/Spanish.json') }}"
                    }
                });

                $('#contrato_table_inactivos').DataTable({
                    "language": {
                        "url": "{{ asset('js/Spanish.json') }}"
                    }
                });

                // Cambio de pestañas
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    var target = $(e.target).attr("href"); // ID del contenido de la pestaña
                    if (target === "#activos") {
                        $('#contrato_table_activos').DataTable().ajax.reload();
                    } else if (target === "#inactivos") {
                        $('#contrato_table_inactivos').DataTable().ajax.reload();
                    }
                });
            });

            function closeAlert(id) {
                const alertToggle = document.getElementById(`alert-toggle-${id}`);
                if (alertToggle) {
                    alertToggle.checked = false;
                }
            }

        </script>
    @endsection
