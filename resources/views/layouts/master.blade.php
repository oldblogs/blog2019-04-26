<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/app.css" rel="stylesheet">
    
  </head>

  <body>

    @include ('layouts.nav')
    
    @if ($flash = session('message'))
    <div id="flash-message" class="alert alert-success" role="alert">
      {{ $flash }}
    </div>
    @endif
    
    <div class="container">
      <div class="row">
        @yield('header')
      
        @yield('content')
    
        @include('layouts.sidebar')
      </div><!-- /.row -->
    </div><!-- /.container -->
  
    @include ('layouts.footer')
  </body>
</html>
