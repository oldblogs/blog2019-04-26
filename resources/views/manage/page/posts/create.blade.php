@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
    <h1>Publish a post</h1>

    <form method="POST" action="{{ route('save_new_post') }}">
      @csrf

      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="published" name="published" >
        <label class="form-check-label" for="published">Published</label>
      </div>

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="postText">
      </div>

      <div class="form-group">
        <label for="body">Body</label>
        <textarea id="body" name="body" class="form-control" cols="80" rows="10"></textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Publish</button>
      </div>

      @include('manage.partial.errors')

    </form>

@endsection
