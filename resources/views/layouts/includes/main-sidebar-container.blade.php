  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('img/logo/logo.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/profile.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            {{ Auth::user()->name }}
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </router-link>
          </li>

        <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
            Starter Pages
            <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <router-link to="/starter-page/active" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>Active page</p>
            </router-link>
            </li>
            <li class="nav-item">
            <router-link to="/starter-page/inactive" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>Inactive page</p>
            </router-link>
            </li>
        </ul>
        </li>
         <li class="nav-item">
            <router-link to="/users" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/profile" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                Profile
                </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/posts" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                Posts
                </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/companys" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                Companys
                </p>
            </router-link>
        </li>
        <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="nav-icon fa fa-power-off"></i>
            <p>
            {{ __('Logout') }}
            </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>