@extends('layouts.app')

@section('template_title')
    Agenda
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
                            <h3> {{ __('Agenda') }} </h3>
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
                    <a href="{{ route('Agenda.pdf') }}" class="btn btn-primary btn-sm ml-2" data-placement="left" target="_blank">
        {{ __('Informe') }}
    </a>
    <a href="{{ route('Agenda.create') }}" class="btn btn-success btn-sm" data-placement="left">
        {{ __('Nueva Agenda') }}
    </a>
    
</div>
                    </div>
                </div>

                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif

                @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
                @endif

                
                <br>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="tab-content">
                    <!-- TAB Activos -->
                    <div class="tab-pane fade show active" id="activos" aria-labelledby="activos-tab">
                        <div class="table-responsive">
                            <table id="agenda_table_activos" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Pacientes</th>
                                        <th>Enfermera</th>
										<th>Fecha Inicio</th>
										<th>Fecha Final</th>
										<th>Eps</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($agendas->where('estado', 0) as $agenda)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $agenda->paciente->nombre }}</td>
											<td>{{ $agenda->usuario->name }}</td>
											<td>{{ $agenda->fecha_inicio }}</td>
											<td>{{ $agenda->fecha_fin }}</td>
                                            <td>
                                                {{ $agenda->contrato ? ($agenda->contrato->eps ? $agenda->contrato->eps->eps . ' - ' . $agenda->contrato->Nro_contrato : 'EPS no asignada') : 'Contrato no asignado' }}
                                            </td>



                                            <td>
                                                <form action="{{ route('Agenda.destroy',$agenda->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('Agenda.show',$agenda->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('Agenda.edit',$agenda->id) }}" data-id="{{ $agenda->id }}"><i class="fa fa-fw fa-edit"></i></a>
                                                        @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB Inactivos -->
                    <div class="tab-pane fade" id="inactivos" aria-labelledby="inactivos-tab">
                        <div class="table-responsive">
                            <table id="agenda_table_inactivos" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Fecha Inicio</th>
										<th>Fecha Final</th>
										<th>Pacientes</th>
										<th>Enfermera</th>
										<th>Eps</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($agendas->where('estado', 1) as $agenda)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $agenda->fecha_inicio }}</td>
											<td>{{ $agenda->fecha_fin }}</td>
											<td>{{ $agenda->paciente->nombre }}</td>
											<td>{{ $agenda->usuario->name }}</td>
                                            <td>
                                                {{ $agenda->contrato ? ($agenda->contrato->eps ? $agenda->contrato->eps->eps . ' - ' . $agenda->contrato->Nro_contrato : 'EPS no asignada') : 'Contrato no asignado' }}
                                            </td>



                                            <td>
                                                <form action="{{ route('Agenda.destroy',$agenda->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('Agenda.show',$agenda->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
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
            {!! $agendas->links() !!}
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/Spanish.json') }}"></script>
    <script>
    $(document).ready(function () {
        $(document).on('click', '.btn-warning', function() {
            const agendaId = $(this).data('id');

            if (agendaId) { // Si tiene un id, es una edición
                // Luego desactivamos los campos en el formulario cuando se carga
                $('#idContrato').prop('disabled', true);
                $('#idPaciente').prop('disabled', true);
                $('#idEnfermera').prop('disabled', true);
            }
        });
        $('#agenda_table_activos').DataTable({
            "language": {
                "url": "{{ asset('js/Spanish.json') }}"
            }
        });
        $('#agenda_table_inactivos').DataTable({
            "language": {
                "url": "{{ asset('js/Spanish.json') }}"
            }
        });
    });
</script>
@endsection
