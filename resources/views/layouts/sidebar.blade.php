<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: darkgoldenrod">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="{{ asset('oil-clinic.png') }}" alt="logo" style="height: 3em; width: 2em;">
      </div>
      <div class="sidebar-brand-text mx-4"> Oil Clinic</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-oil-can"></i>
        <span style="color: white;">Dashboard</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('oil') }}">
        <i class="fas fa-fw fa-oil-can"></i>
        <span style="color: white;">Condemning Limit</span></a>
    </li>

    {{-- <li class="nav-item">
      <a class="nav-link" href="/profile">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Profile</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


  </ul>
