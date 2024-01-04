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
<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $nombre_empresa; ?></title>
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

<body>
    <section id="container">
        <header id="header">
            <!--logo start-->
            <div class="brand">
                <a href="./?view=dashboard"><span><?php echo $nombre_empresa; ?></span></a>
            </div>
            <!--logo end-->
            <div class="toggle-navigation toggle-left">
                <button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right" title="Ocultar Menu">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="user-nav">
                <ul>
                    <li class="profile-photo">
                        <img src="<?php echo $STRIMG ?>" height="40px" width="40px" alt="" class="img-circle">
                    </li>
                    <li class="dropdown settings">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php echo $STRNOM . " " . $STRAPE; ?> <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu animated fadeInDown">
                            <li>
                                <a href="./?view=perfil"><i class="fa fa-user"></i> Mi Perfil</a>
                            </li>
                            <li>
                                <a href="./?view=logout"><i class="fa fa-power-off"></i> Salir</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>

        </header>
        <!--sidebar left start-->
        <aside class="sidebar">




            <div id="leftside-navigation" class="nano">
                <ul class="nano-content">
                    <?php if ($_SESSION['dashboard'] == 1) { ?>
                        <li class="<?php if (isset($active2)) {
                                        echo $active2;
                                    } ?>">
                            <a href="./?view=dashboard"><i class="fa fa-home" aria-hidden="true"></i><span>Inicio</span></a>
                        </li>
                    <?php } ?>


                </ul>

                <!--   <ul class="nano-content">

                    <?php if ($_SESSION['dashboard'] == 1) { ?>
                        <li class="<?php if (isset($active2)) {
                                        echo $active2;
                                    } ?>">
                            <a href="./?view=dashboard"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a>
                        </li>


                    <?php } ?>
                    <?php if ($_SESSION['empleados'] == 1) { ?>
                        <li class="<?php if (isset($active2)) {
                                        echo $active2;
                                    } ?>">
                            <a href="./?view=empleados"><i class="fa fa-users"></i><span>Empleados</span></a>
                        </li>
                    <?php } ?>



                    <?php if ($_SESSION['productos'] == 1) { ?>
                        <li class="<?php if (isset($active2)) {
                                        echo $active2;
                                    } ?>">
                            <a href="./?view=productos"><i class="fa fa-users"></i><span>Productos</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['solicitud'] == 1) { ?>
                        <li class="<?php if (isset($active2)) {
                                        echo $active2;
                                    } ?>">
                            <a href="./?view=solicitud"><i class="fa fa-users"></i><span>Solicitud</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['categorias'] == 1) { ?>
                        <li class="<?php if (isset($active2)) {
                                        echo $active2;
                                    } ?>">
                            <a href="./?view=categorias"><i class="fa fa-users"></i><span>Categoria</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['subcategorias'] == 1) { ?>
                        <li class="<?php if (isset($active2)) {
                                        echo $active2;
                                    } ?>">
                            <a href="./?view=subcategorias"><i class="fa fa-users"></i><span>Subcategoria</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['unidades'] == 1) { ?>
                        <li class="<?php if (isset($active2)) {
                                        echo $active2;
                                    } ?>">
                            <a href="./?view=Unidades"><i class="fa fa-users"></i><span>Unidades de medida</span></a>
                        </li>
                    <?php } ?>






                </ul>-->
                <!--menu casa-->
                <!--menu casa-->
                <!--productos-->
                <div class="btn-group-vertical btn-group-justified">
                    <div class="btn-group ">
                        <button type="button" class="btn btn-default  btnLeft dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-th" aria-hidden="true"></i>&nbspCatalogo

                        </button>
                        <ul class="dropdown-menu">
                            <?php if ($_SESSION['productos'] == 1) { ?>
                                <li class="<?php if (isset($active2)) {
                                                echo $active2;
                                            } ?>">
                                    <a href="./?view=productos"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>&nbspProductos</span></a>
                                </li>
                            <?php } ?>

                            <?php if ($_SESSION['categorias'] == 1) { ?>
                                <li class="<?php if (isset($active2)) {
                                                echo $active2;
                                            } ?>">
                                    <a href="./?view=categorias"><i class="fa fa-tags" aria-hidden="true"></i><span>&nbspCategoria</span></a>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION['subcategorias'] == 1) { ?>
                                <li class="<?php if (isset($active2)) {
                                                echo $active2;
                                            } ?>">
                                    <a href="./?view=subcategorias"><i class="fa fa-tags" aria-hidden="true"></i><span>&nbspSubcategoria</span></a>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION['unidades'] == 1) { ?>
                                <li class="<?php if (isset($active2)) {
                                                echo $active2;
                                            } ?>">
                                    <a href="./?view=Unidades"><i class="fa fa-underline" aria-hidden="true"></i><span>Unidades de medida</span></a>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION['empleados'] == 1) { ?>
                                <li class="<?php if (isset($active2)) {
                                                echo $active2;
                                            } ?>">
                                    <a href="./?view=empleados"><i class="fa fa-users"></i><span>Empleados</span></a>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
                <!--end-productos-->

                <div id="leftside-navigation" class="nano">
                    <ul class="nano-content">

                        <?php if ($_SESSION['solicitud'] == 1) { ?>
                            <li class="<?php if (isset($active2)) {
                                            echo $active2;
                                        } ?>">
                                <a href="./?view=solicitud"><i class="fa fa-folder-open" aria-hidden="true"></i><span>Solicitud</span></a>
                            </li>
                        <?php } ?>

                    </ul>

                    <div class="btn-group-vertical btn-group-justified">
                    <div class="btn-group ">
                    <?php if ($_SESSION['Inventario'] == 1) { ?>
                        <button type="button" class="btn btn-default  btnLeft dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tasks" aria-hidden="true"></i>&nbspInventarios

                        </button>
                        <?php } ?>
                        <ul class="dropdown-menu">
                            
                            <?php if ($_SESSION['Entradas'] == 1) { ?>
                                <li class="<?php if (isset($active2)) {
                                                echo $active2;
                                            } ?>">
                                    <a href="./?view=Entradas"><i class="fa fa-level-up" aria-hidden="true"></i><span>&nbspEntradas y Salidas</span></a>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION['Control'] == 1) { ?>
                                <li class="<?php if (isset($active2)) {
                                                echo $active2;
                                            } ?>">
                                    <a href="./?view=historial"><i class="fa fa-sort" aria-hidden="true"></i><span>Control</span></a>
                                </li>
                            <?php } ?>

                            

                        </ul>
                    </div>
                </div>
                <!--end-productos-->



        </aside>

        <!--sidebar left end-->