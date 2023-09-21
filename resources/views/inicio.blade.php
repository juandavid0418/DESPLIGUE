@extends('layouts.app')

@section('template_title')
    User
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center">My medical help</h3>
                        <hr style="border-top: px solid #000;">
                        <link rel="stylesheet" href="{{ asset('dist/css/style2.css') }}" >
                         <div class="row mt-4">
<div class="col-md-4">
    <div class="card">
        <div class="card-body" style="background-color: #E74C3C; color: white; border-radius: 10px;">
            <h4 class="card-title">Enfermeros Registrados</h4>
            <h4 class="card-text">{{ $totalUsers }}</h4>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card">
        <div class="card-body" style="background-color: #E74C3C; color: white; border-radius: 10px;">
            <h4 class="card-title">Pacientes Registrados</h4>
            <h4 class="card-text">{{ $totalPacientes }}</h4>
        </div>
    </div>
</div>

    
<div class="col-md-4">
    <div class="card">
        <div class="card-body" style="background-color: #E74C3C; color: white; border-radius: 10px;">
            <h4 class="card-title">Contratos</h4>
            <h4 class="card-text">{{ $totalContratos }}</h4>
        </div>
    </div>
</div>
<h3>¿Qué Somos?</h3>
    <div class="divi">
        
            <p>Nuestro proyecto tiene como finalidad investigar sobre las nuevas tecnologías, por esto mismo nos encargaremos de desarrollar un sistema de tercerización de servicios de enfermeras domiciliarias por zonas, esto con el fin de tener una mayor agilidad y cobertura en las enfermeras de hogar, eso va directamente para impactar el sector de la salud domiciliaria en la ciudad de Medellín, se tendrán en cuenta el desarrollo e impacto del producto en la ciudad, tanto la satisfacción de las EPS como de los pacientes, para así llegar a una mayor recopilación de información y obtener unos resultados favorables.. </p>
        <div class="img-logo">
    <img class="img" alt="centered " src='img/corazon.png' width="300px" height="200px" >
</div>

    </div>
  


                    </div>
                  
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
