<div class="card card-default m-b-1 w-50">
  <div class="card-body">
    <h5 class="card-title">User information</h5>
    <table class="table table-striped">
      <tbody>
        <tr>
          <th scope="row">Name : </th>
          <td>{{$bloguser->name}}</td>
        </tr>
        <tr>
          <th scope="row">E-mail : </th>
          <td>{{$bloguser->email}}</td>
        </tr>
        <tr>
          <th scope="row">Role : </th>
          {{-- TODO: Fix following row. List roles --}}
          <td>@role('admin') admin, @endrole @role('apiadmin') apiadmin, @endrole @role('member') member @endrole </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3"></div>
