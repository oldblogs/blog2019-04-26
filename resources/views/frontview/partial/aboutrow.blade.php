<div class="col-sm-12 col-md-12 col-lg-6">
  <div class="card mb-3">
    <div class="card-body">
      <img class="card-img-top img-thumbnail" style="max-height: 6rem; max-width: 6rem;" src="{{ asset('img/profile.png') }}" alt="Photo of user" height="60" width="60"> 
      <h3 class="card-title">{{ $about->title }}</h5>
      <h4 class="card-subtitle mb-2 text-muted">{{ $about->subtitle }}</h6>
      <p class="card-text">{{ $about->body }}</p>
      <h5 class="card-title">Email(s)</h5>
      <ul class="list-group list-group-flush">
        @foreach ($about->user->emails as $email)
          <li class="list-group-item"><span class="badge badge-pill badge-light">{{ $email->title }}</span> {{ $email->email }}</li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
