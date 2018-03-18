    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ action('ManageController@index') }}">{{ config('app.name') }}</a>

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{ action('SessionsController@destroy') }}">Sign out</a>
        </li>
      </ul>
    </nav>