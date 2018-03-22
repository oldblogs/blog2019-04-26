@extends ('manage.base.master')

@section ('title')
DevsBlog
@endsection

@section ('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Posts</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('getpostform') }}">Add</a>
              </div>
            </div>
          </div>

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
                @foreach ($posts as $post)
                  @include ('manage.partial.postrow')
                @endforeach
              </tbody>
            </table>
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul> 
          </div>
@endsection

