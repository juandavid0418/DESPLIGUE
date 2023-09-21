<!DOCTYPE html>
<html>
<head>
  <title>Restablecer contraseña</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/style.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <link rel="icon" type="image/png" href="{{ asset('dist/img/log.png') }}">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Restablecer contraseña') }}</div>

          <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
              @csrf

              <div class="form-input">
                <span><i class="fa fa-envelope-o"></i></span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">
              </div>
              @error('email')
              <span class="invalid-feedback" role="alert" style="display: block;">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

              <div class="mb-0">
                <button type="submit" class="btn btn-block text-uppercase">
                  {{ __('Enviar enlace para restablecer contraseña') }}
                </button>
                <a href="/login" class="btn btn-block text-uppercase">Volver</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="img-left d-none d-md-flex"></div>
</body>
</html>
