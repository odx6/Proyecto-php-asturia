<?php
if (isset($_SESSION['user_id']) && $_SESSION !== null) {
  header("location: ./?view=dashboard");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>
 
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Toastr -->
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <script src="./plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
</head>

<body>
  <!--<section id="login-container" style="width: 95%">
    <div class="row">
      <div class="col-md-3" id="login-wrapper">
        <div class="panel panel-primary animated flipInY">
          <div class="panel-heading">
            <h3 class="panel-title">
              Iniciar Sessión
            </h3>
          </div>
          <div class="panel-body">
            <?php

            if (isset($_GET['invalid'])) {
              echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                                    <strong>Error!</strong> Contraseña o correo Electrónico invalido
                                    </div>";
            }
            ?>
            <p> Ingresa Tus Datos.</p>
            <form class="form-horizontal" role="form" method="post" action="view/resources/login.php">
              <div class="form-group">
                <div class="col-md-12">
                  <input type="text" class="form-control" name="email" id="email" value="admin@admin.com" autofocus>
                  <i class="fa fa-user"></i>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="password" class="form-control" name="password" id="password" value="admin">
                  <i class="fa fa-lock"></i>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <button name="token" class="btn btn-primary btn-block" type="submit">Acceder</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>-->

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="./?view=index"><b>Asturias</b> S.A C.V</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Iniciar Sesion</p>
          <?php

          if (isset($_GET['invalid'])) {
            echo '  <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
            Error al intentar iniciar sesion verifique que sus datos sean correctos
          </div>';
          }
          ?>
          <form method="post" action="view/resources/login.php">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="admin@admin.com" autofocus>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="admin">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Acceder</button>
              </div>
              <!-- /.col -->
            </div>
          </form>


          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="forgot-password.html">Olvide mi contraseña</a>
          </p>

        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <script src="./plugins/jquery/jquery.min.js"></script>
    
  
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
<script src="./plugins/toastr/toastr.min.js"></script>

    <script src="./dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>

  </body>

</html>