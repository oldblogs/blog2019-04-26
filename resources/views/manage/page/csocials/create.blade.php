@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
    <h1>Add a new social network</h1>

    <form method="POST" action="{{ route('csocials.store') }}">
      @csrf

      <div class="form-group">
        <label for="order">Order</label>
        <input type="number" class="form-control" id="order" name="order" aria-describedby="Prority of the social network" value=1>
      </div>

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="Title of the social network">
      </div>

      <div class="form-group">
        <label for="css_class">CSS Class</label>
        <input type="text" class="form-control" id="css_class" name="css_class" aria-describedby="CSS class of the sopcial network">
      </div>

      <div class="form-group">
        <label for="homepage">Homepage of the social network</label>
        <input type="text" class="form-control" id="homepage" name="homepage" aria-describedby="Homepage of the social network">
      </div>
      
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Publish</button>
      </div>

      @include('manage.partial.errors')

    </form>

@endsection
