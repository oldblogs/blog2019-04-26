@extends ('frontview.base.master')

@section ('title')
DevsBlog
@endsection

@section ('header')
    <div class="blog-header">
      <div class="container">
        <h1 class="blog-title">DevsBlog</h1>
        <p class="lead blog-description">An example blog template built with Bootstrap.</p>
      </div>
    </div>
@endsection

@section ('content')
  <div class="col-sm-8 blog-main">
    @foreach ($posts as $post)
      @include ('frontview.partial.post')
    @endforeach

    <nav class="blog-pagination">
      <a class="btn btn-outline-primary" href="#">Older</a>
      <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
    </nav>

  </div><!-- /.blog-main -->
@endsection


 