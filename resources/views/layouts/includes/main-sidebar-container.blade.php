  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
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
                <p> Account Management <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/player/create" class="nav-link">
                        <p>Add Player</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/player/list" class="nav-link">
                        <p>Player List</p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Referral <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/referral/list" class="nav-link">
                        <p>Referral Name</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/referral/history" class="nav-link">
                        <p>History</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/referral/transaction" class="nav-link">
                        <p>Transaction</p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> RakeBack <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/rakeback/limit" class="nav-link">
                        <p>RakeBack Limit</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/rakeback/history" class="nav-link">
                        <p>History</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/rakeback/running-bet" class="nav-link">
                        <p>Running Bet</p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Report <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/report/player/transaction" class="nav-link">
                        <p>Player Transaction</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/report/player/running-bet" class="nav-link">
                        <p>Running Bet</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/report/player/winlost" class="nav-link">
                        <p>Win \ Lose</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/report/player/daily" class="nav-link">
                        <p>Daily Player Report Bet</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/report/player/month" class="nav-link">
                        <p>Monthly Report </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/report/player/history-coin" class="nav-link">
                        <p>Histry Coin</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/report/player/history-operator" class="nav-link">
                        <p>Histry Operator</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/report/player/jackport" class="nav-link">
                        <p>Jackport</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/report/player/bonus" class="nav-link">
                        <p>Bonus</p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Tools <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/tools/memo" class="nav-link">
                        <p>Memo</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/tools/online" class="nav-link">
                        <p>Online List</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/tools/game" class="nav-link">
                        <p>Game Control</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/tools/statistic" class="nav-link">
                        <p>Statistic</p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Log <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/log/agent" class="nav-link">
                        <p>Agent Log</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/log/player" class="nav-link">
                        <p>Player Log</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/log/downline" class="nav-link">
                        <p>Downline Log</p>
                    </router-link>
                </li>
            </ul>
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