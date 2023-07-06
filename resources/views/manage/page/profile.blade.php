@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name') }}
@endsection

@section ('content')
  @if ($bloguser)
    <div class="d-flex justify-content-between flex-wrap align-items-center  mb-3 border-bottom">
      <h1 class="h2">User Profile Page</h1>
    </div>
    
    @include ('manage.partial.userinfo')

    @include ('manage.partial.sociallogins')
    
  @endif

  <about></about>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">Contact information</h2>
  </div>

  <emails></emails>

  <sociallinks></sociallinks>

  <tests></tests>
  
@endsection
