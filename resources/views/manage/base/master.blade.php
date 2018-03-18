<!DOCTYPE html>
{{--  Based on Bootstrap Dashboard example 
        https://getbootstrap.com/docs/4.0/examples/dashboard
--}}
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    
  </head>

  <body>
  
    @include ('manage.partial.nav')
    
    <div class="container-fluid">
      <div class="row">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          @yield('content')
        </main>

        @include ('manage.partial.sidebar')
      </div>
    </div>
    
    <script src="/js/app.js"></script>
    
    <!-- Icons -->
    <!-- <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script> -->
    <script>
      feather.replace()
    </script>
    
    @yield('otherjs')
    
  </body>
</html>
