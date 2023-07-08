@extends ('frontview.base.master')

@section ('content')

<h2 class="blog-about-title">About</h2>

<div class="row">
  @foreach ($abouts as $about)
    @include ('frontview.partial.aboutrow')
  @endforeach
</div>
@endsection



