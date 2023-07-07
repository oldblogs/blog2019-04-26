@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
  <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
  </div>
  <p>TODO: Add website metrics here.</p>
  <br>
  <posts></posts>
  <br>
  <media></media>
  <br>

  <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">OAuth</h1>
  </div>
  <passport-clients></passport-clients>
  <passport-authorized-clients></passport-authorized-clients>
  <passport-personal-access-tokens></passport-personal-access-tokens>

@endsection
