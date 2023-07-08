@extends ('frontview.base.master')

@section ('title')
  {{ config('app.name', 'Blog') }}
@endsection

@section ('content')

  @foreach ($posts as $post)

    @if ($loop->first)
      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic">{{ $post->title }}</h1>
          <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
          <p class="lead mb-0"><a href="/posts/{{ $post->id }}" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>
      </div>
    @else
      @include ('frontview.partial.post')
    @endif

  @endforeach

@endsection
