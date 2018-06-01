@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
    <h1>New About entry</h1>

    <form method="POST" action="{{ route('abouts.store') }}">
      @csrf

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="Title of the new about entry.">
      </div>

      <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" class="form-control" id="subtitle" name="subtitle" aria-describedby="Subtitle of the new about entry.">
      </div>

      <div class="form-group">
        <label for="body">Body</label>
        <textarea id="body" name="body" class="form-control" cols="80" rows="10" aria-describedby="Text of the new about entry."></textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

      @include('manage.partial.errors')

    </form>

@endsection
