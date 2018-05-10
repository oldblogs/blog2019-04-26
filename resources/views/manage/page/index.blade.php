@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
          <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
          </div>
          <div class="card">
            <div class="card-body">
              <p class="card-text">Hi {{$bloguser->name}} !</p>
            </div>
          </div>

@endsection

