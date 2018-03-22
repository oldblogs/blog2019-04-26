<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    <link href="/css/app.css" rel="stylesheet">
    
  </head>

  <body>

    @include ('frontview.partial.nav')
    
    @if ($flash = session('message'))
    <div id="flash-message" class="alert alert-default" role="alert">
      {{ $flash }}
    </div>
    @endif
    
    <div class="container">
      <div class="row">
        @yield('header')
      
        @yield('content')
    
        @include('frontview.partial.sidebar')
      </div><!-- /.row -->
    </div><!-- /.container -->
  
    @include ('frontview.partial.footer')
    <script src="/js/app.js"></script>
    
  </body>
</html>
