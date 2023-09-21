@extends('layouts.app')

@section('template_title')
    Historia
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
                               <h3> {{ __('Historia') }}</h3>
                            </span>

                            <div class="float-right">
                    <a href="{{ route('Historia.pdf') }}" class="btn btn-primary btn-sm ml-2" data-placement="left" target="_blank">
        {{ __('Informe') }}
    </a>
    <a href="{{ route('Historia.create') }}" class="btn btn-success btn-sm" data-placement="left">
        {{ __('Nuevo Historia') }}
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
                        <div class="table-responsive">
                            <table id ="historia_table" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Paciente</th>
										<th>Diagnóstico</th>
										<th>Signos Vitales</th>
										<th>Antecedentes</th>
										<th>Evolución</th>
										<th>Tratamiento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historias as $historia)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $historia->paciente->nombre }}</td>
											<td>{{ $historia->diagnostico }}</td>
											<td>{{ $historia->signosvitales }}</td>
											<td>{{ $historia->antecedentesalergicos }}</td>
											<td>{{ $historia->evolucion }}</td>
											<td>{{ $historia->tratamiento }}</td>
											

                                            <td>
                                                <form action="{{ route('Historia.destroy',$historia->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('Historia.show',$historia->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('Historia.edit',$historia->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $historias->links() !!}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/Spanish.json') }}"></script>

<script>
        $(document).ready(function () {
            $('#historia_table').DataTable({
                "language": {
                    "url": "{{ asset('js/Spanish.json') }}"
                }
            });
        });
    </script>
@endsection
