@extends ('frontview.base.master')

@section ('content')
  <h2 class="blog-about-title">About</h2>
  
  @foreach ($abouts as $about)
    @include ('frontview.partial.aboutrow')
  @endforeach
  <ul>
    <p>Social Media Icons</p>
    <li><i class="fa-solid fa-twitter"></i>&nbsp;</li>
  </ul>
@endsection



