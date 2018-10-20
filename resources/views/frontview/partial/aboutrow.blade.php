
<div class="card flex-md-row mb-4 box-shadow h-md-250">
  <div class="card-body d-flex flex-column align-items-start">
    <div class="row">
        <div class="col-xs-2">
            <img src="{{ asset('images/profile.png') }}" alt="" height="60" width="60"> 
        </div>
        <div class="col-xs-10">
            <h3 class="mb-0">{{ $about->title }}</h3>
            <div class="mb-1 text-muted">{{ $about->subtitle }}</div>
        </div>
    </div>
    <div class="row">
      <div class="col-xs">
        <p class="card-text mb-auto">{{ $about->body }}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs">
        <h5 class="mb-0">Email(s)</h5>
        <table>
          <tbody>
            @foreach ($about->user->emails as $email)
              <tr>
                <td>{{ $email->title }}</td>
                <td>{{ $email->email }}</td>
              </tr>
            @endforeach
          </tbody>
        <table>
      </div>
    </div>
  </div>
</div>

