<div class="bottom-nav">
    <a class="nav-item lokasi{{ request()->routeIs('lokasi') ? 'active' : '' }}" href="/dashboard/lokasi">
        <span class="nav-icon">📍</span>
        <span>Lokasi</span>
    </a>

    <a class="nav-item riwayat{{ request()->routeIs('riwayat') ? 'active' : '' }}" href="/dashboard/riwayat">
        <span class="nav-icon">📋</span>
        <span>Riwayat</span>
    </a>

    <a class="nav-item middle-item {{ request()->routeIs('buat') ? 'active' : '' }}" href="/dashboard">
        <span class="nav-icon">+</span>
    </a>

    <a class="nav-item pantau{{ request()->routeIs('pantau') ? 'active' : '' }}" href="/dashboard/pantau">
        <span class="nav-icon">📊</span>
        <span>Pantau</span>
    </a>

    <a class="nav-item akun{{ request()->routeIs('akun') ? 'active' : '' }}" href="/dashboard/akun">
        <span class="nav-icon">👤</span>
        <span>Akun</span>
    </a>
</div>