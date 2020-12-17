
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <script type="text/javascript" src="../assets/js/Chart.js"></script>
	<script src="../assets/js/jquery.js"></script> 
	<script src="../assets/js/zoom.js"></script> 
  <title>Customer Service</title>

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../assets/css/sb-admin-2.css" rel="stylesheet">
  <link href="../assets/css/custom.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-new-primary-gradient sidebar sidebar-new accordion text-dark toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>
            <li class="nav-item">
                <a class="nav-link" href="../Admin/">
                  <i class="fas fa-fw fa-comments"></i>
                  <span id="notifFeedback">
                    Feedback
                  </span>
                </a>
            </li>
          
      
       <?php
    if($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses']=='Admin1'){
            echo '
             <li class="nav-item">
                <a class="nav-link" href="../Admin/list_request.php">
                  <i class="fas fa-fw fa-folder"></i>
                  <span id="notifRequest">
                    Request
                  </span>
                </a>
              </li>';
    }
    
    
    
    if($_SESSION['hak_akses']=='Super Admin'){
      echo '<li class="nav-item">
        <a class="nav-link" href="../Admin/list_departemen.php">
          <i class="fas fa-fw fa-building"></i>
          <span>Departemen</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="../Admin/list_account.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Akun</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Admin/list_customer.php">
          <i class="fas fa-fw fa-users"></i>
          <span id="notifCustomer">
            Customer
          </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Admin/list_lokasi.php">
          <i class="fas fa-fw fa-map-marker"></i>
          <span>Lokasi</span></a>
      </li>';
    }
        ?>
        
      <li class="nav-item">
        <a class="nav-link" href="grafik.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Laporan</span></a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      
      <!-- Nav Item - Charts -->
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="img-profile rounded-circle fas fa-user" style="padding-top:2px;font-size:15px;margin-top:10px;"></i>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama'];?></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="pengaturan.php">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Pengaturan
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
