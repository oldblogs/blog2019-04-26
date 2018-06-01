@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')

  <div class="blog-about">
    <h2 class="blog-about-title">{{ $about->title }}</h2>
    <h4 class="blog-subtitle">{{ $about->subtitle }}</h4>
    <p>{{ $about->body }}</p>
    <hr/>
    <p class="blog-about-meta">Created : {{ $about->created_at->toFormattedDateString() }}</p>
    <p class="blog-about-meta">Updated : {{ $about->updated_at->toFormattedDateString() }}</p>
  </div>

@endsection

