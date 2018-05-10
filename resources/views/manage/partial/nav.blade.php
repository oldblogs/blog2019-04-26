      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ action('PostController@index') }}">{{ config('app.name') }}</a>

      <ul class="navbar-nav px-3">
        {{-- Authentication Links --}}
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              {{ auth()->user()->email }}&nbsp;&nbsp;&nbsp;{{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      </ul>
    
