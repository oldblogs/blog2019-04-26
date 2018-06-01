@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
    <h1>Edit an about record</h1>

    <form method="POST" action="{{ route('abouts.update', $about) }}">
      @method('PATCH')
      @csrf

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="Title of about record" value="{{ $about->title }}" >
      </div>

      <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" class="form-control" id="subtitle" name="subtitle" aria-describedby="Subtitle of about record" value="{{ $about->subtitle }}" >
      </div>

      <div class="form-group">
        <label for="body">Body</label>
        <textarea id="body" name="body" class="form-control" cols="80" rows="10" aria-describedby="Text body of about record">{{ $about->body }}</textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

      @include('manage.partial.errors')

      <hr/>
      <p class="blog-about-meta">Created : {{ $about->created_at->toFormattedDateString() }}</p>
      <p class="blog-about-meta">Updated : {{ $about->updated_at->toFormattedDateString() }}</p>

    </form>

@endsection
