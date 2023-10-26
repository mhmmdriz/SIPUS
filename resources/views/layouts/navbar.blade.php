<nav class="navbar navbar-expand-lg bg-body-tertiary {{ Cookie::get('navbar') }}">
  <div class="container">
    <div class="navbar-nav ms-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          @if (auth()->user()->role == "petugas")
              Welcome back,  {{ auth()->user()->petugas->nama }}
          @elseif(auth()->user()->role == "anggota")
            Welcome back,  {{ auth()->user()->anggota->nama }}  
          @endif
        </a>
        <div class="dropdown-menu row">
            <div class="col-md-auto">
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
              </form>
            </div>
        </div>
      </li>
    </div>
  </div>
</nav>