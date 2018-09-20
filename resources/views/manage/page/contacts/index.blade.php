@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h2 class="h2">Contacts</h2>
    </div>

    <emails></emails>

    <sociallinks></sociallinks>
@endsection

