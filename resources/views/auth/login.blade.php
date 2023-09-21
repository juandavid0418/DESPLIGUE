<!DOCTYPE html>
<html>
<head>
  <title>Iniciar sesión</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/style.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <link rel="icon" type="image/png" href="{{ asset('dist/img/logoo.png') }}">
  
</head>
<body>
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body">
          <h4 class="title text-center mt-4">
            Iniciar sesión
          </h4>
          <form class="form-box px-3" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="email" name="email" placeholder="Email" tabindex="10" required>
            </div>
            <div class="form-input">
              <span><i class="fa fa-key"></i></span>
              <input type="password" name="password" placeholder="Contraseña" required>
            </div>

            <div class="mb-3">
              @error('login')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <button type="submit" class="btn btn-block text-uppercase">
                Iniciar sesión
              </button>
            </div>
            @if (Route::has('password.request'))
                                   <center> <a  class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a></center>
                                @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


