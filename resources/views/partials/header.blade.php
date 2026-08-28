  <header class="header">
    <div class="header-left">
        <button class="mobile-menu-toggle" id="mobile-menu-toggle"><i class="fas fa-bars"></i></button>
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search">
        </div>
    </div>
    
    <div class="header-right">
        <div class="header-icon-group">
            <div class="dropdown">
                <button class="icon-btn dropdown-toggle">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">5</span>
                </button>
                <div class="dropdown-menu">
                    <div class="dropdown-header">Notifications</div>
                    <a href="#">New user registered</a>
                    <a href="#">Server #12 overloaded.</a>
                    <a href="#">New order received</a>
                    <div class="dropdown-footer"><a href="#">View All</a></div>
                </div>
            </div>
        </div>
        
        <div class="dropdown profile-dropdown">
            <button class="profile-btn dropdown-toggle">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="User Avatar">
                <div class="profile-info">
                    {{-- Menampilkan Nama User yang Login --}}
                    <span class="profile-name">{{ Auth::user()->name }}</span>
                </div>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> Profile</a>
                
                {{-- Fitur Logout Standar Laravel Breeze --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </div>
    </div>
</header>