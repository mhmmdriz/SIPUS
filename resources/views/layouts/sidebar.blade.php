{{-- @dd({{ Cookie::get('nama_cookie') }}) --}}
<nav class="sidebar {{ Cookie::get('sidebar') }}" id="sidebar">
  <header>
    <div class="image-text">
      <span class="image">
        <img src="/img/logo.png" alt="logo">
      </span>

      <div class="text header-text">
        <span class="name">SIPUS</span>
        <span class="sub-name">SI Perpustakaan</span>
      </div>
    </div>

    <i class='bx bx-chevron-right toggle'></i>
  </header>
  
  <hr>

  <div class="menu-bar">
    <div class="menu">
      <ul class="menu-links">
        <li class="nav-link {{ Request::is('/') ? 'active' : '' }}">
          <a href="/">
            <i class="bx bx-home-alt icon"></i>
            <span class="text nav-text">Dashboard</span>
          </a>
        </li>

        @if (auth()->user()->role == "petugas")
        <li class="nav-link {{ Request::is('buku*') ? 'active' : '' }}">
          <a href="/buku">
            <i class="bx bx-book icon"></i>
            <span class="text nav-text">Buku</span>
          </a>
        </li>
        <li class="nav-link {{ Request::is('kategori*') ? 'active' : '' }}">
          <a href="/kategori">
            <i class="bx bx-category icon"></i>
            <span class="text nav-text">Kategori Buku</span>
          </a>
        </li>
        <li class="nav-link {{ Request::is('anggota*') ? 'active' : '' }}">
          <a href="/anggota">
            <i class="bx bx-group icon"></i>
            <span class="text nav-text">Anggota</span>
          </a>
        </li>
        <li class="nav-link {{ Request::is('pengembalian*') ? 'active' : '' }}">
          <a href="/pengembalian">
            <i class='bx bxs-book-bookmark icon'></i>
            <span class="text nav-text">Pengembalian Buku</span>
          </a>
        </li>
        <li class="nav-link {{ Request::is('riwayat*') ? 'active' : '' }}">
          <a href="/riwayat-transaksi">
            <i class='bx bx-receipt icon'></i>
            <span class="text nav-text">Riwayat Transaksi</span>
          </a>
        </li>
        @endif
        
      </ul>
    </div>

    <div class="bottom-content">
      <li class="">
        <a href="">
            <i class="bx bx-log-out icon"></i>
            <span class="text nav-text">Logout</span>
        </a>
      </li>
      
      <li class="mode">
        <div class="moon-sun">
          <i class="bx bx-moon icon moon"></i>
          <i class="bx bx-sun icon sun"></i>
        </div>
        <span class="mode-text text">Dark Mode</span>

        <div class="toggle-switch">
          <span class="switch"></span>
        </div>
      </li>
    </div>
  </div>
</nav>
