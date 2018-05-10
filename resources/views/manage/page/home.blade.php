@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
    <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">User Home Page</h1>
    </div>
    <div class="card w-50">
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
@endsection

