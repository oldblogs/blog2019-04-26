@extends ('frontview.base.master')

@section ('title')
  {{ config('app.name', 'Blog') }}
@endsection

@section ('content')

  @foreach ($posts as $post)

    @include ('frontview.partial.post')

  @endforeach

  {{ $posts->links() }}
@endsection
