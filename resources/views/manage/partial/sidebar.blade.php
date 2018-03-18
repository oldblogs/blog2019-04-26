        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('manage')?'active':'' }}" href="{{ action('ManageController@index') }}">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('manage/posts')?'active':'' }}" href="{{ action('ManageController@postslist') }}">
                  <span data-feather="file-text"></span>
                  Posts
                </a>
              </li>
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
            </ul>
          </div>
        </nav>