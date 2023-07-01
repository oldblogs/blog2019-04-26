
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('home')?'active':'' }}" href="{{ action('HomeController@index') }}">
                  <span data-feather="home"></span>
                  Home
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link {{ Request::is('manage')?'active':'' }}" href="{{ action('DashboardController@index') }}">
                  <span data-feather="grid"></span>
                  Manage <span class="sr-only">(current)</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ Request::is('manage/posts')?'active':'' }}" href="{{ action('ManageController@postslist') }}">
                  <span data-feather="file-text"></span>
                  Posts
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ Request::is('manage/csocials')?'active':'' }}" href="{{ action('CsocialController@index') }}">
                  <span data-feather="globe"></span>
                  Social Networks
                </a>
              </li>

            </ul>
          </div>