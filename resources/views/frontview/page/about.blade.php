@extends ('frontview.base.master')

@section ('content')
  <div class="blog-about">
    <h2 class="blog-about-title">About</h2>
    
    @foreach ($abouts as $about)
      @include ('frontview.partial.aboutrow')
    @endforeach

  </div>
@endsection



