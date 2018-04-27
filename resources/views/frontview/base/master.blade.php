<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    <link href="/css/app.css" rel="stylesheet">
    
  </head>

  <body>
    <div class="container">
      @include ('frontview.partial.nav')
      @yield ('header')
    </div>

    <main role="main" class="container">
      <div class="row">
        @if ($flash = session('message'))
        <div id="flash-message" class="alert alert-default" role="alert">
          {{ $flash }}
        </div>
        @endif
        
        <div id="app" class="col-md blog-main">
          @yield('content')
        </div>
      </div>
    </main>
    
    @include ('frontview.partial.footer')
    
    <script src="/js/app.js"></script>
    
    <script>
      feather.replace()
    </script>
    
    @yield('otherjs')
    
  </body>
</html>
