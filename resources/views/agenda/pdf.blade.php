$<!doctype html>
<html lang="en">

<head>
  <title>Agenda</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<style>
    .thead{
        background-color: black;
        color: white;
    }
    .btn{
        background-color: green;
    }
</style>
<body>
    <h1 class="text-center">Agenda</h1>
<table id="contrato_table_activos" class="table" style="text-align: center; font-size; 20px">
<thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Fecha Inicio</th>
										<th>Fecha Final</th>
										<th>Pacientes</th>
										<th>Enfermera</th>
										<th>Eps</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agendas as $agenda)
                                        <tr>
                                            <td>{{ $agenda->id }}</td>
                                            
											<td>{{ $agenda->fecha_inicio }}</td>
											<td>{{ $agenda->fecha_fin }}</td>
											<td>{{ $agenda->paciente->nombre }}</td>
											<td>{{ $agenda->usuario->name }}</td>
                                            <td>
                                                {{ $agenda->contrato ? ($agenda->contrato->eps ? $agenda->contrato->eps->eps . ' - ' . $agenda->contrato->Nro_contrato : 'EPS no asignada') : 'Contrato no asignado' }}
                                            </td>



                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                                    </table>
  <header>
    <!-- place navbar here -->
  </header>
  <main>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>