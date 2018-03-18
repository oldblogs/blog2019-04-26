@extends ('manage.base.master')

@section ('content')
  <div class="col-md-8">
    <h1>Sign In</h1>
    <form method="POST" action="/{{ config('app.management', 'asd') }}/login">
      {{ csrf_field() }}
      
      <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Sign In</button>
      </div>
      
      @include ('manage.partial.errors')
      
    </form>
  </div>
@endsection