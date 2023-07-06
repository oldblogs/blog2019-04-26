<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
{{--  Based on Bootstrap Dashboard example 
        https://getbootstrap.com/docs/4.0/examples/dashboard
--}}
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>@yield('title')</title>

    <link href="/css/fontawesome.css" rel="stylesheet">
    <link href="/css/brands.css" rel="stylesheet">
    <link href="/css/solid.css" rel="stylesheet">

    <link href="/css/dashboard.css" rel="stylesheet">
    
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      @include ('manage.partial.nav')
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          @include ('manage.partial.navman')
        </nav>
        <main role="main" id="app" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">
          {{-- TODO: Implement better flash message handling  --}}
          @if ($flash = session('message'))
            <div id="flash-message" class="alert alert-success" role="alert">
              {{ $flash }}
            </div>
          @elseif ($flash = session('error'))
            <div id="flash-message" class="alert alert-danger" role="alert">
              {{ $flash }}
            </div>
          @endif
          <div class="col-md-12 blog-main">
            @yield('content')
          </div>
        </main>
      </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    
    <script>
      feather.replace()
    </script>
    
    @yield('otherjs')
    
  </body>
</html>
