<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    </head>
    <body class="grad">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-6 center-wrapper">
                        <img src="/imgs/logo_nombre_blanco.png" width="300">
                    </div>
                    <div class="col-6 center-wrapper">
                        <div class="container w-50">
                            <div class="row">
                                <div class="col-12">
                                    @if(Session::has('message'))
                                        <div class="alert alert-danger">
                                            {{Session::get('message')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <form method="POST" action="/login">
                                        @csrf
                                        <div class="form-group">
                                          <label class="special-form-label">Email</label>
                                          <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" required>
                                          @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="form-group">
                                          <label class="special-form-label">Password</label>
                                          <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" required>
                                          @error('passport')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="center-wrapper">
                                            <button type="submit" class="btn btn-primary">Ingresar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
