@extends ('layouts.master')

@section ('title')
Devsblog - {{ $post->title }}
@endsection

@section ('custom_style_links')
  <link href="/css/blog.css" rel="stylesheet">
@endsection

@section ('content')
  <div class="col-sm-8 blog-main">
    <div class="blog-post">
      <h2 class="blog-post-title">{{ $post->title }}</h2>
      <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>

      {{ $post->body }}

    </div><!-- /.blog-post -->

  </div><!-- /.blog-main -->
@endsection


 