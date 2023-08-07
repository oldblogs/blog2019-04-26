@extends ('frontview.base.master')

@section ('title')
  {{ $post->title }}
@endsection

@section ('content')

  <div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>

    {!! $post->body !!}

    <p>
      <img class="card-img-left img-thumbnail mb-3" style="max-height: 6rem; max-width: 6rem;" src="{{ asset('storage/'.$post->user->about->photo) }}" alt="Photo of user" height="50" width="50"> 
      <a class="p-2 text-muted" href="{{ action('AboutController@index') }}">{{ $post->user->about->title }}</a>
    </p>

  </div>

@endsection

