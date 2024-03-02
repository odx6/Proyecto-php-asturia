<?php
$user_ip = $_SERVER['REMOTE_ADDR'];
if (!isset($_SESSION['user_id']) && $_SESSION['user_id'] == null) {
  header("location: ./?view=index");


  // Guarda $user_ip en la base de datos o utilízalo como necesites
}

$id = $_SESSION['user_id'];
$query = mysqli_query($con, "SELECT * from tblcatemp where IDEMP=$id");
while ($row = mysqli_fetch_array($query)) {
  $IDEMP = $row['IDEMP'];
  $STRNSS = $row['STRNSS'];
  $STRRFC = $row['STRRFC'];
  $STRCUR = $row['STRCUR'];
  $STRNOM = $row['STRNOM'];
  $STRAPE = $row['STRAPE'];
  $STRLOC = $row['STRLOC'];
  $STRMUN = $row['STRMUN'];
  $STREST = $row['STREST'];
  $STRCP = $row['STRCP'];
  $STRPAI = $row['STRPAI'];
  $STRTEL = $row['STRTEL'];
  $STRCOR = $row['STRCOR'];
  $STRPWS = $row['STRPWS'];
  $BITSUS = $row['BITSUS'];
  $STRIMG = $row['STRIMG'];
  $CREATE_AT = $row['CREATE_AT'];
}

$configuracion = mysqli_query($con, "select * from configuracion");
$rw = mysqli_fetch_array($configuracion);
$nombre_empresa = $rw['nombre'];
?>
<!--Header go -->
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> <?php echo $nombre_empresa ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini">

  <!--Header end -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
        
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
        <!-- Menu  para cerrar sesion -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-cogs"></i>
            
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <div class="dropdown-divider"></div>
            <a href="./?view=perfil" class="dropdown-item">
              <i class="far fa-smile"></i> Perfil

            </a>
            <div class="dropdown-divider"></div>
            <a href="./?view=logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Salir

            </a>
           
          </div>
        </li>
      
        <!-- end Menu -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="./?view=dashboard" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $nombre_empresa ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo  $STRIMG ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $STRNOM ?></a>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php if ($_SESSION['dashboard'] == 1) { ?>
              <li class="nav-item">
                <a href="./?view=dashboard" class="nav-link">
                  <i class="fas fa-home"></i>
                  <p>
                    Inicio

                  </p>
                </a>
              </li>
            <?php } ?>

            <li class="nav-item ">
              <a href="#" class="nav-link ">
                <i class="fas fa-book"></i>
                <p>
                  Catalogos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" >
                <?php if ($_SESSION['unidades'] == 1) { ?>
                  <li class="nav-item">
                    <a href="./?view=Unidades" class="nav-link ">
                      <i class="fas fa-stopwatch-20"></i>
                      <p>&nbsp;Unidades de medida</p>
                    </a>
                  </li>
                <?php } ?>

                <?php if ($_SESSION['categorias'] == 1) { ?>
                  <li class="nav-item">
                    <a href="./?view=categorias" class="nav-link ">
                      <i class="fas fa-bookmark"></i>
                      <p> &nbsp; Categorias</p>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($_SESSION['subcategorias'] == 1) { ?>

                  <li class="nav-item">
                    <a href="./?view=subcategorias" class="nav-link">
                      <i class="fas fa-bookmark"></i>
                      <p>&nbsp;Subcategorias</p>
                    </a>
                  </li>
                <?php } ?>

                <?php if ($_SESSION['productos'] == 1) { ?>
                  <li class="nav-item">
                    <a href="./?view=productos" class="nav-link">
                      <i class="fab fa-product-hunt"></i>
                      <p>&nbsp;Productos</p>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($_SESSION['empleados'] == 1) { ?>
                  <li class="nav-item">
                    <a href="./?view=empleado" class="nav-link">
                      <i class="fas fa-users"></i>
                      <p>&nbsp;Empleados</p>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($_SESSION['vehiculos'] == 1) { ?>
                  <li class="nav-item">
                    <a href="./?view=vehiculos" class="nav-link">
                    <i class="fas fa-car"></i>
                      <p>&nbsp;Vehiculos</p>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($_SESSION['proveedores'] == 1) { ?>
                  <li class="nav-item">
                    <a href="./?view=proveedores" class="nav-link">
                    <i class="fas fa-parachute-box"></i>
                      <p>&nbsp;Proveedores</p>
                    </a>
                  </li>
                <?php } ?>


              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link ">
                <i class="fas fa-clipboard-list"></i>
                <p>
                  &nbsp; Inventario
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" >
                <?php if ($_SESSION['Entradas'] == 1) { ?>
                  <li class="nav-item">
                    <a href="./?view=Entrada" class="nav-link ">
                      <i class="fas fa-dolly"></i>
                      <p>&nbsp;Entradas y Salidas</p>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($_SESSION['compras'] == 1) { ?>
                  <li class="nav-item">
                    <a href="./?view=Compras" class="nav-link ">
                    <i class="fas fa-money-bill-alt"></i> 
                    <p>&nbsp;Compras</p>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($_SESSION['Control'] == 1) { ?>

                  <li class="nav-item">
                    <a href="./?view=historial" class="nav-link ">
                      <i class="fas fa-dolly-flatbed"></i>
                      <p> &nbsp;Control</p>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </li>
            <?php if ($_SESSION['solicitud'] == 1) { ?>
              <li class="nav-item">
                <a href="./?view=solicitud" class="nav-link">
                  <i class="fas fa-tractor"></i>
                  <p>
                    &nbsp; Solicitud

                  </p>
                </a>
              </li>
            <?php } ?>
            <?php if ($_SESSION['registros'] == 1) { ?>
              <li class="nav-item">
                <a href="./?view=log" class="nav-link">
                  <i class="far fa-list-alt"></i>
                  <p>
                    &nbsp; Registro

                  </p>
                </a>
              </li>
            <?php } ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!--Header end -->