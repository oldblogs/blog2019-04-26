@extends ('frontview.base.master')

@section ('title')
  Test
@endsection

@section ('content')

  <div>
    <h2>Test</h2>
    <table>
      <tr><th>token</th><td>{{$user->token}}</td></tr>
      <tr><th>expiresIn</th><td>{{$user->expiresIn}}</td></tr>
      <tr><th>id</th><td>{{$user->id}}</td></tr>
      <tr><th>email</th><td>{{$user->email}}</td></tr>
    </table>

  </div>

@endsection
