@extends('layouts.app')

@section('template_title')
    Ep
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <h3>{{ __('Eps') }}</h3>
                            </span>

                             <div class="float-right">
                                <a href="{{ route('Ep.create') }}" class="btn btn-success btn-sm float-right"  data-placement="left">
                                  {{ __('Nueva eps') }}
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Eps</th>

										<th>General</th>

										<th>Principal</th>

										<th>Direccion</th>


                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eps as $ep)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $ep->eps }}</td>

											<td>{{ $ep->telefonogeneral }}</td>

											<td>{{ $ep->telefonoprincipal }}</td>

											<td>{{ $ep->direccion }}</td>


                                            <td>
                                                <form action="{{ route('Ep.destroy',$ep->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-warning" href="{{ route('Ep.edit',$ep->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                                                    
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $eps->links() !!}
            </div>
        </div>
    </div>
@endsection


<!-- @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button> -->
