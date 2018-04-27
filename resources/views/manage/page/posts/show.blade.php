@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')

  <div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p>@if ($post->published)
      Published
      @else
      Not Published
      @endif
    </p>
    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>

    {{ $post->body }}
    
  </div>

@endsection

