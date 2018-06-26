@extends ('manage.base.master')

@section ('title')
  Manage - {{ config('app.name', 'Blog') }}
@endsection

@section ('content')

  <div class="blog-post">
    <table>
        <tr><th>Order     : </th><td>{{ $csocial->order }}</td></tr>
        <tr><th>Title     : </th><td>{{ $csocial->title }}</td></tr>
        <tr><th>CSS Class : </th><td>{{ $csocial->css_class }}</td></tr>
        <tr><th>Homepage  : </th><td>{{ $csocial->homepage }}</td></tr>
        <tr><th>Created   : </th><td>{{ $csocial->created_at->toFormattedDateString() }}</td></tr>
    </table>
   
  </div>

@endsection

