@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
    <h1>Edit  social network info</h1>

    <form method="POST" action="{{ route('csocials.update', $csocial) }}">
      @method('PATCH')
      @csrf

      <div class="form-group">
        <label for="order">Order</label>
        <input type="text" class="form-control" id="order" name="order" aria-describedby="Order of the social network" value="{{ $csocial->order }}">
      </div>

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="Title of the social network" value="{{ $csocial->title }}">
      </div>

      <div class="form-group">
        <label for="css_class">CSS Class</label>
        <input type="text" class="form-control" id="css_class" name="css_class" aria-describedby="CSS class of the social network" value="{{ $csocial->css_class }}">
      </div>
      
      <div class="form-group">
        <label for="homepage">Homepage of social network</label>
        <input type="text" class="form-control" id="homepage" name="homepage" aria-describedby="Homepage of social network" value="{{ $csocial->homepage }}">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

      @include('manage.partial.errors')

    </form>

@endsection
