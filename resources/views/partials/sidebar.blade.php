<aside class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="logo">SIM Karyawan</a>
        <button class="sidebar-toggle-btn" id="sidebar-toggle">
            <i class="fa-solid fa-circle-dot"></i>
        </button>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <!-- Menu Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i><span>Dashboard</span>
                </a>
            </li>

            <!-- Menu Users / Karyawan (Aktif juga saat menambah/mengedit karyawan jika routenya menggunakan 'employees.*') -->
            <li>
                <a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees.index*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i><span>Users</span>
                </a>
            </li>

            <!-- Menu Histori -->
            <li>
                <a href="{{ route('employees.all-history') }}" class="{{ request()->routeIs('employees.all-history') ? 'active' : '' }}">
                    <i class="fas fa-history"></i><span>Histori</span>
                </a>
            </li>

            <!-- Menu Laporan -->
            <li>
                <a href="{{ route('employees.export.form') }}" class="{{ request()->routeIs('employees.export.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-excel"></i><span>Laporan</span>
                </a>
            </li>

            <!-- Menu Dokumentasi -->
             <li>
                <a href="{{ route('employees.docs') }}" class="{{ request()->routeIs('employees.docs') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-alt"></i><span>Dokumentasi</span>
                </a>
            </li>

            <!-- Menu Lainnya (Belum ada routenya) -->
            {{-- <li><a href="#"><i class="fa-solid fa-calendar-days"></i><span>Calendar</span></a></li>
            <li><a href="#"><i class="fa-solid fa-life-ring"></i><span>Support</span></a></li> --}}
           
        </ul>
    </nav>
</aside>