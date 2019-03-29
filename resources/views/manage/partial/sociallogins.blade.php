<div class="card card-default">
  <div class="card-body">
    <h4 class="h4 pt-2 ">Your linked social logins</h4>
    <h6 class="h6  pb-2 border-bottom">Click to review permissions</h6>
    @foreach ($bloguser->socialids as $social)
      @if ($social->socialprovider->review)
        <a type="button" class = "btn btn-default" 
          href="{{ $social->socialprovider->review }}">{{ $social->socialprovider->provider }}</a>
      @else
        <a type="button" class="btn btn-default disabled">{{ $social->socialprovider->provider }}</a>
      @endif
    @endforeach
  </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3"></div>

@if ($availableps)
<div class="card card-default">
  <div class="card-body">
    <h4 class="card-title">Add a social login to your account</h4>
      @foreach ( $availableps as $provider )
        <a type="button" class="btn btn-default" href="{{ $provider['auth_endpoint'] }}">{{ $provider['provider'] }}</a>
      @endforeach
  </div>
</div>
@endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3"></div>