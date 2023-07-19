<div class="col-sm-12 col-md-12 col-lg-6">
  <div class="card mb-3">
    <div class="card-body">
      <img class="card-img-top img-thumbnail mb-3" style="max-height: 6rem; max-width: 6rem;" src="{{ asset('storage/'.$about->photo) }}" alt="Photo of user" height="60" width="60"> 
      <h3 class="card-title">{{ $about->title }}</h5>
      <h4 class="card-subtitle mb-2 text-muted">{{ $about->subtitle }}</h6>
      <p class="card-text">{{ $about->body }}</p>
      <h5 class="card-title">Contact information:</h5>
      <ul class="list-group list-group-flush">
        @foreach ($about->user->emails as $email)
          <li class="list-group-item"><i class="fa-solid  fa-xl fa-envelope"></i>&nbsp;&nbsp;{{ $email->email }}</li>
        @endforeach
      </ul>
      <ul class="list-group list-group-flush">
        @foreach ($about->user->sociallinks as $sociallink)
          <a href="{{ $sociallink->link }}" class="list-group-item"><i class="fa-brands fa-xl {{ $sociallink->csocial->css_class }}"></i>&nbsp;&nbsp;{{ $sociallink->link }}</a>
        @endforeach
      </ul>
    </div>
  </div>
</div>
