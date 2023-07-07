
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          {{-- <a class="text-muted" href="#">Subscribe</a> --}}
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="#">Large</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="nav-link text-muted" href="#">
          {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
          </a>
        </div>
      </div>
    </header>
    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-end">
        <a class="p-2 text-muted" href="{{ action('PostController@index') }}">Posts</a>
        <a class="p-2 text-muted" href="{{ action('AboutController@index') }}">About</a>
      </nav>
    </div>



