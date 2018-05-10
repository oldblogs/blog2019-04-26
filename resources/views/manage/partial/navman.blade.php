
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              @can('view','App\Dashboard')
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('manage')?'active':'' }}" href="{{ action('DashboardController@index') }}">
                    <span data-feather="grid"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                </li>
              @endcan

              <li class="nav-item">
                <a class="nav-link {{ Request::is('home')?'active':'' }}" href="{{ action('HomeController@index') }}">
                  <span data-feather="home"></span>
                  Home
                </a>
              </li>

              
              @can('browse','App\Post')
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('manage/posts')?'active':'' }}" href="{{ action('ManageController@postslist') }}">
                    <span data-feather="file-text"></span>
                    Posts
                  </a>
                </li>
              @endcan

              {{--
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="user"></span>
                    About
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="inbox"></span>
                    Contact
                  </a>
                </li>
              --}}
            </ul>
          </div>