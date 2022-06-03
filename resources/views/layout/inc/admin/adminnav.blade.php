 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
  
        </div>
      </li>
  
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
  
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
  
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  
  
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" id="asidebar">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      {{-- <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light" style="margin-left:80px;">
       {{ Auth::user()->name }}
            
        
        
      </span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
  
          <li class="nav-item">
            <a href="{{ route('admin-index')}}" class="nav-link {{ (Route::is('admin-index')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{ (Route::is('manage-users', 'create-user' , 'create-acivity')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: #222;
            background-image: linear-gradient(315deg, #396375 0%, #2222 74%);">
              <li class="nav-item">
                <a href="{{ route('create-user')}}" class="nav-link {{ (Route::is('create-user')) ? 'active' : '' }}">
                  <i class="fa fa-plus-circle nav-icon" aria-hidden="true"></i>
                  <p>Create User</p>
                </a>
              </li>
  
              <li class="nav-item">
                <a href="{{route('manage-users')}}" class="nav-link {{ (Route::is('manage-users')) ? 'active' : '' }}">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Manage Users</p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{route('create-acivity')}}" class="nav-link {{ (Route::is('create-acivity')) ? 'active' : '' }}">
                    <i class="fas fa-school nav-icon"></i>
                  <p>Create New Activity</p>
                </a>
            </li>
  
            </ul>
          </li>
  
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{ (Route::is('show-chart', 'show-reports', 'show-user-activity')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="style=background-color: #222;
            background-image: linear-gradient(315deg, #396375 0%, #2222 74%);">
              <li class="nav-item">
                <a href="{{ route('show-chart') }}" class="nav-link {{ (Route::is('show-chart')) ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>View Employee Statics</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('show-reports')}}" class="nav-link {{ (Route::is('show-reports')) ? 'active' : '' }}">
                  <i class="fa fa-plus-circle nav-icon" aria-hidden="true"></i>
                  <p>Specific Report's</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('show-user-activity')}}" class="nav-link {{ (Route::is('show-user-activity')) ? 'active' : '' }} ">
                  <i class="fa fa-book nav-icon" aria-hidden="true"></i>
                  <p>User All Activity List</p>
                </a>
              </li>
  
            </ul>
          </li>
  
  
          <li class="nav-item">
            <a href="{{ route('create-holiday') }}" class="nav-link {{ (Route::is('create-holiday')) ? 'active' : '' }}">
                <i class="nav-icon far fa-calendar-alt"></i>
              <p >Create Holiday</p>
            </a>
          </li>
            
          <li class="nav-item">
            <a href="{{ route('show-holiday') }}" class="nav-link {{ (Route::is('show-holiday')) ? 'active' : '' }}">
                <i class="fas fa-suitcase nav-icon"></i>
              <p >All Holiday</p>
            </a>
          </li>
  
  
          <li class="nav-item">
              <a href="{{ route('admin-password')}}" class="nav-link {{ (Route::is('admin-password')) ? 'active' : '' }}">
                  <i class="fas fa-lock-open"></i>
                <p >Change Password</p>
              </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('activity-logIn-logOut') }}" class="nav-link {{ (Route::is('activity-logIn-logOut')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-edit"></i>
              <p >Check Logs</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin-profile') }}" class="nav-link {{ (Route::is('admin-profile')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-edit"></i>
              <p >Update Profile</p>
            </a>
          </li>
  
          <li class="nav-item">
              <a href="{{route('logout')}}" class="nav-link {{ (Route::is('logout')) ? 'active' : '' }}">
                  <i class="fas fa-sign-out-alt"></i>
                <p >Logout</p>
              </a>
            </li>
  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
  
    </div>
    <!-- /.sidebar -->
  </aside>
  