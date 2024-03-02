<?php
if (isset($_SESSION['user_id']) && $_SESSION !== null) {
  header("location: ./?view=dashboard");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inicio de sesion</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!--cdn para bootstrap5-->
    <!--<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!--cdn para end bootstrap5-->

    <!-- Fonts from Font Awsome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Custom styles for this theme -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- Vector Map  -->
    <link rel="stylesheet" href="assets/plugins/jvectormap/css/jquery-jvectormap-1.2.2.css">
    <!-- ToDos  -->
    <link rel="stylesheet" href="assets/plugins/todo/css/todos.css">
    <!-- Morris  -->
    <link rel="stylesheet" href="assets/plugins/morris/css/morris.css">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <!-- Feature detection -->
    <script src="assets/js/modernizr-2.6.2.min.js"></script>
    <!--PDFS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <!--end-PDFS-->
    <!-- <link rel="stylesheet" href="assets/plugins/selectpicker/bootstrap-select.min.css"> -->
    <!-- <link rel="stylesheet" href="assets/plugins/select2/css/select2.css"> -->
    <style>
        .btnLeft {

            text-align: left;

            color: black;
            text-decoration: none;
            display: block;
            padding: 18px 0 18px 25px;
            font-size: 16px;
            outline: 0;
            -webkit-transition: all 200ms ease-in;
            -o-transition: all 200ms ease-in;
            -moz-transition: all 200ms ease-in;

        }
    </style>

</head>
</head>

<body>
  <section id="login-container" style="width: 95%">
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
  </section>
  
  </section><!-- /end container  -->

<!--Global JS-->
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/waypoints/waypoints.min.js"></script>
<script src="assets/plugins/nanoScroller/jquery.nanoscroller.min.js"></script>
<script src="assets/js/application.js"></script>


</body>
</html>

  