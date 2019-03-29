@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h2 class="h2">Socials networks</h2>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('csocials.create') }}">Add</a>
        </div>
      </div>
    </div>
    
    <p>Social networks list that can be used in Contacts section.</p>
    
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Title</th>
            <th>Created</th>
            <th>Modified</th>
            <th>Read</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($csocials as $csocial)
            @include ('manage.partial.csocialrow')
          @endforeach
        </tbody>
      </table>

    </div>

@endsection