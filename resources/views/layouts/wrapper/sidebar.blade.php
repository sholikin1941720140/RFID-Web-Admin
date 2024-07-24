<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#1166d8;">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link" style="border-color: white;">
    <img src="{{url('dist/img/polinema.png')}}" alt="SIMAS Logo" class="brand-image img-circle elevation-3" 
    style="opacity: .8;background-color: white;">
    <span class="brand-text font-weight-light">SIMA</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-color: white;">
      <div class="image" style="opacity: 0">
      User:
      </div>
      <div class="info">
        <a href="/about" class="d-block">
            <b>{{ Auth::user()->name }}</b>
        </a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    {{-- <nav class="mt-2">
      <a href="/dashboard" class="nav-link d-flex align-items-center {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-chart-line"></i>
        <p class="ml-2 mb-0">Dashboard</p>
      </a>
      <a href="/arsip-surat" class="nav-link d-flex align-items-center {{ Request::segment(1) == 'arsip-surat' ? 'active' : '' }}">
        <i class="nav-icon fas fa-envelope"></i>
        <p class="ml-2 mb-0">Arsip Surat</p>
      </a>
      <a href="/kategori" class="nav-link d-flex align-items-center {{ Request::segment(1) == 'kategori' ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p class="ml-2 mb-0">Kategori</p>
      </a>
      <a href="/about" class="nav-link d-flex align-items-center {{ Request::segment(1) == 'about' ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p class="ml-2 mb-0">About</p>
      </a>
    </nav> --}}
    <nav class="mt-2">
      @include('layouts.wrapper.role.'.$role)
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<style>
  .nav-link {
    padding: 10px 10px;
    color: #4b4b4b;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
  }

  .nav-link i {
    min-width: 24px;
    text-align: center;
    vertical-align: middle;
  }

  .nav-link p {
    margin-bottom: 0;
    line-height: 1.5;
    vertical-align: middle;
  }

  .nav-link:hover {
    background-color: #005fc5;
    color: #fff;
  }

  .nav-link.active {
    background-color: #007bff;
    color: white;
  }

  .nav-link.active i {
    color: white;
  }
</style>
