@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
    <h1>Edit a post</h1>

    <form method="POST" action="{{ route('updatepost', $post) }}">
      @method('PATCH')
      @csrf

      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="published" name="published" @if ($post->published) 
          checked
          @endif>
        <label class="form-check-label" for="published">Published</label>
      </div>

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="postText" value="{{ $post->title }}" >
      </div>

      <div class="form-group">
        <label for="body">Body</label>
        <textarea id="body" name="body" class="form-control" cols="80" rows="10">{{ $post->body }}</textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

      @include('manage.partial.errors')

    </form>

@endsection
