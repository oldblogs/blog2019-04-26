@extends ('frontview.base.master')

@section ('title')
  {{ config('app.name', 'Blog') }}
@endsection

@section ('content')

  @foreach ($posts as $post)

    @include ('frontview.partial.post')

  @endforeach

  <div class="card">
    <div class="card-body d-flex flex-column align-items-center">
      {{ $posts->links() }}
    </div>
  </div>

@endsection
