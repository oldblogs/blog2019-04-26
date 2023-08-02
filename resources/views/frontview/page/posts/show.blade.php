@extends ('frontview.base.master')

@section ('title')
  {{ $post->title }}
@endsection

@section ('content')

  <div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>

    {!! $post->body !!}
    <img style="max-height: 6rem; max-width: 6rem;" src="{{ asset('storage/'.$about->photo) }}" alt="Photo of user">
  </div>

@endsection

