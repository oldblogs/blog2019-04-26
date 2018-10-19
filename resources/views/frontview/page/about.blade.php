@extends ('frontview.base.master')

@section ('content')
  <div class="blog-about">
    <h2 class="blog-about-title">About</h2>
    <p>.</p>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>Title</th>
          <th>Subtitle</th>
          <th>Body</th>
          <th>Photo</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($abouts as $about)
          @include ('frontview.partial.aboutrow')
        @endforeach
      </tbody>
    </table>
  </div>

@endsection

