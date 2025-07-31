<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistem IoT Estafet</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['fullname']?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="?page=dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard</p>
            </a>
            </li>
          <li class="nav-item">
            <a href="?page=datasensor" class = "nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p> Data Sensor</p>
            </a>
            </li>
          <li class="nav-item">
            <a href="?page=dataaktuator" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p> Data Aktuator</p>
            </a>
            </li>
          <li class="nav-item">
            <a href="?page=device" class="nav-link">
              <i class="nav-icon fas fa-laptop-code"></i>
              <p>Perangkat</p>
            </a>
            </li>
            <?php if($_SESSION['role'] == "Admin"){ ?>
          <li class="nav-item">
            <a href="?page=user" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Pengguna</p>
            </a>

            </li>
            <?php } ?>
            <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>