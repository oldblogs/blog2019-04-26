@extends ('manage.base.master')

@section ('content')
  <div class="col-sm-8 blog-main">

    <h1>Edit a post</h1>

    <form method="POST" action="{{ route('updatepost', $post) }}">
      @method('PATCH')
      @csrf

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="postText" value="{{ $post->title }}" >
      </div>

      <div class="form-group">
        <label for="body">Body</label>
        <textarea id="body" name="body" class="form-control" cols="80" rows="10">{{ $post->body }}</textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Publish</button>
      </div>

      @include('manage.partial.errors')

    </form>


  </div>
@endsection
