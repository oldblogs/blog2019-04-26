
          <div class="sidebar-sticky">
            <ul class="nav flex-column">

              <li class="nav-item">
                <a class="nav-link {{ Request::is('manage')?'active':'' }}" 
                  href="{{ action('DashboardController@index') }}">
                  <i class="fa-solid fa-bars"></i>&nbsp;Manage</a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ Request::is('profile')?'active':'' }}" 
                  href="{{ action('ProfileController@index') }}">
                  <i class="fa-solid fa-user"></i>&nbsp;Profile</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link {{ Request::is('manage/posts')?'active':'' }}" 
                  href="{{ action('ManageController@postslist') }}">
                  <i class="fa-solid fa-newspaper"></i>&nbsp;Posts</a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ Request::is('manage/csocials')?'active':'' }}" 
                  href="{{ action('CsocialController@index') }}">
                  <i class="fa-regular fa-share-nodes"></i>&nbsp;Social Networks</a>
              </li>

            </ul>
          </div>