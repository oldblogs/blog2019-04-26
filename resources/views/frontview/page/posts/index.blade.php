@extends ('frontview.base.master')

@section ('title')
  {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
  <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
      <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
      <p>
        <i class="fa-brands fa-xl fa-twitter"></i>&nbsp;
        <i class="fa-brands fa-xl fa-medium"></i>&nbsp;
        <i class="fa-brands fa-xl fa-github"></i>&nbsp;
        <i class="fa-brands fa-xl fa-reddit-alien"></i>&nbsp;
        <i class="fa-brands fa-xl fa-youtube"></i>&nbsp;
        <i class="fa-brands fa-xl fa-codepen"></i>&nbsp;
        <i class="fa-brands fa-xl fa-wordpress"></i>&nbsp;
        <i class="fa-brands fa-xl fa-discord"></i>&nbsp;
        <i class="fa-brands fa-xl fa-tiktok"></i>&nbsp;
        <i class="fa-brands fa-xl fa-facebook"></i>&nbsp;
        <i class="fa-brands fa-xl fa-instagram"></i>&nbsp;
        <i class="fa-brands fa-xl fa-whatsapp"></i>&nbsp;
        <i class="fa-brands fa-xl fa-behance"></i>&nbsp;
        <i class="fa-brands fa-xl fa-pinterest"></i>&nbsp;
        <i class="fa-brands fa-xl fa-snapchat"></i>&nbsp;
        <i class="fa-brands fa-xl fa-free-code-camp"></i>&nbsp;


      </p>
    </div>
  </div>

  @foreach ($posts as $post)
    @include ('frontview.partial.post')
  @endforeach

@endsection
