@extends ('layouts.master')

@section ('title')
DevsBlog
@endsection

@section ('custom_style_links')
  <link href="/css/blog.css" rel="stylesheet">
@endsection

@section ('header')
    <div class="blog-header">
      <div class="container">
        <h1 class="blog-title">The Bootstrap Blog</h1>
        <p class="lead blog-description">An example blog template built with Bootstrap.</p>
      </div>
    </div>
@endsection

@section ('content')
        <div class="col-sm-8 blog-main">
          @foreach ($posts as $post)
            @include ('posts.post')
          @endforeach

          <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
          </nav>

        </div><!-- /.blog-main -->
@endsection


 