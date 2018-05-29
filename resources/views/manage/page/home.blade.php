@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name') }}
@endsection

@section ('content')
  @if ($bloguser)
    <div class="d-flex justify-content-between flex-wrap align-items-center  mb-3 border-bottom">
      <h1 class="h2">User Home Page</h1>
    </div>
    
    <div class="card card-default m-b-1 w-50">
      <div class="card-body">
        <h5 class="card-title">User information</h5>
        <table class="table table-striped">
          <tbody>
            <tr>
              <th scope="row">Name : </th>
              <td>{{$bloguser->name}}</td>
            </tr>
            <tr>
              <th scope="row">E-mail : </th>
              <td>{{$bloguser->email}}</td>
            </tr>
            <tr>
              <th scope="row">Role : </th>
              <td>@role('admin') admin @else @role('member') member @endrole @endrole</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>


    <div class="card card-default">
      <div class="card-body">
        <h4 class="h4 pt-2 ">Your linked social logins</h4>
        <h6 class="h6  pb-2 border-bottom">Click to review permissions</h6>
        @foreach ($bloguser->socialids as $social)
          @if ($social->socialprovider->review)
            <a type="button" class = "btn btn-default" href="{{ $social->socialprovider->review }}">{{ $social->socialprovider->provider }}</a>
          @else
            <a type="button" class="btn btn-default disabled">{{ $social->socialprovider->provider }}</a>
          @endif
        @endforeach
      </div>
    </div>    
    @if ($availableps)
    <div class="card card-default">
      <div class="card-body">
        <h5 class="card-title">Add a social login to your account</h5>
        
          @foreach ( $availableps as $provider )
            <a type="button" class="btn btn-default" href="{{ $provider['auth_endpoint'] }}">{{ $provider['provider'] }}</a>
          @endforeach
        
      </div>
    </div>
    @endif
    
    <div class="card card-default">
      <div class="card-body">
        <h5 class="card-title">Vue Test</h5>
        <p id="app">
          <vue-test></vue-test>
        </p>
      </div>
    </div>
  @endif    
@endsection
