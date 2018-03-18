@extends ('manage.base.master')

@section ('title')
DevsBlog
@endsection

@section ('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Posts</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Add</button>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#ID</th>
                  <th>User</th>
                  <th>Title</th>
                  <th>Created</th>
                  <th>Modified</th>
                  <th>Read</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1,001</td>
                  <td>Mehmet Akif Ersoy</td>
                  <td>ipsum as das d as d as d as  d asd asdasdasd as d as das das d</td>
                  <td>2018-01-03T02:04</td>
                  <td>dolor</td>
                  <td><button class="btn btn-sm btn-outline-secondary"><span data-feather="book-open"></span></button></td>
                  <td><button class="btn btn-sm btn-outline-secondary"><span data-feather="edit-3"></button></td>
                  <td><button class="btn btn-sm btn-outline-secondary"><span data-feather="trash-2"></button></td>
                </tr>
                <tr>
                  <td>1,002</td>
                  <td>amet</td>
                  <td>consectetur</td>
                  <td>adipiscing</td>
                  <td>elit</td>
                  <td>sit</td>
                </tr>
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

