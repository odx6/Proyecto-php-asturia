<?php
$active2 = "active";

include "resources/header copy.php";
include "./config/funciones.php";
if (empty($_REQUEST['id'])) {
    header("location: ./?view=index");
}
if ($_SESSION['empleados'] == 1 && in_array(2, $_SESSION['Habilidad']['Empleados']) && $_SESSION['user_id'] == 1) {
    $id_user = $_REQUEST['id'];
    //$id_user = 25;
    $empleado = mysqli_query($con, "select * from tblcatemp where IDEMP=$id_user");
    $rw = mysqli_fetch_object($empleado);
    $IDEMP = $rw->IDEMP;
    $STRNSS = $rw->STRNSS;
    $STRRFC = $rw->STRRFC;
    $STRCUR = $rw->STRCUR;
    $STRNOM = $rw->STRNOM;
    $STRAPE = $rw->STRAPE;
    $STRDOM = $rw->STRDOM;
    $STRLOC = $rw->STRLOC;
    $STRMUN = $rw->STRMUN;
    $STREST = $rw->STREST;
    $STRCP = $rw->STRCP;
    $STRPAI = $rw->STRPAI;
    $STRTEL = $rw->STRTEL;
    $STRCOR = $rw->STRCOR;
    $STRPWS = $rw->STRPWS;
    $BITSUS = $rw->BITSUS;
    $STRIMG = $rw->STRIMG;
    $CREATE_AT = $rw->CREATE_AT;
?>
    <!--main content start-->
    <?php

    $Titulo = "Permisos Empleados";
    $Arbol = 'Permisos';


    ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permisos del empleado </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Permisos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">
            <!--inicio de los permisos -->

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="<?php echo $STRIMG ?>" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center"><?php echo $STRNOM . " " . $STRAPE ?></h3>

                    <p class="text-muted text-center"><?php echo $STRCOR ?></p>
                    <p class="text-muted text-center"><?php echo $IDEMP ?></p>


                </div>
                <!-- /.card-body -->
            </div>


            <div class="col-12" id="all">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#alle">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                               Selector global
                            </h4>
                        </div>
                    </a>
                    <div id="alle" class="collapse show" data-parent="#alle">
                        <div class="card-body">
                           
                               
                            <input id="crearglobal"  type="checkbox" style="font-size:xx-small" data-nombre="crearglobal" name="crearglobal" onchange="chekCrear('crearglobal','CREAR')"  >&nbsp;CREAR EN TODAS LAS VISTAS &nbsp;</input>
                            <input id="modificar"  type="checkbox" style="font-size:xx-small" data-nombre="modificar" name="modificar" onchange="chekCrear('modificar','MODIFICAR')">&nbsp;MODIFICAR  EN TODAS LAS VISTAS&nbsp;</input>
                            <input id="eliminarglobal"  type="checkbox" style="font-size:xx-small" data-nombre="eliminarglobal" name="eliminarglobal" onchange="chekCrear('eliminarglobal','ELIMINAR')">&nbsp;ELIMINAR EN TODAS LAS VISTAS&nbsp;</input>
                            <input id="mostrarglobal"  type="checkbox" style="font-size:xx-small" data-nombre="mostrarglobal" name="mostrarglobal" onchange="chekCrear('mostrarglobal','MOSTRAR')">&nbsp;MOSTRAR EN TODAS LAS VISTAS&nbsp;</input>
                            <input id="exportarglobal"  type="checkbox" style="font-size:xx-small" data-nombre="exportarglobal" name="exportarglobal" onchange="chekCrear('exportarglobal','EXPORTAR')">&nbsp;EXPORTAR EN TODAS LAS VISTAS&nbsp;</input>
                           
                        </div>
                    </div>
                </div>
            </div>
            <form role="form" name="update_register" id="update_register" method="post" action="view/ajax/agregar/actualizar_permisos.php">
                <div class="row">




                    <?php


                    $marcados = mysqli_query($con, "SELECT * FROM empleado_permisos WHERE idempleado=$id_user");
                    $valores = array();




                    while ($reg = $marcados->fetch_object()) {
                        $skil = explode(",", $reg->Habilidades);

                    ?>
                        <div class="col-6" id="<?php consultarNombre($reg->idpermiso, 'permisos', 'id', 'nombre'); ?>">
                            <div class="card card-primary card-outline">
                                <a class="d-block w-100" data-toggle="collapse" href="#<?php consultarNombre($reg->idpermiso, 'permisos', 'id', 'nombre'); ?>">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <?php consultarNombre($reg->idpermiso, 'permisos', 'id', 'nombre'); ?>
                                        </h4>
                                    </div>
                                </a>
                                <div id="<?php consultarNombre($reg->idpermiso, 'permisos', 'id', 'nombre'); ?>" class="collapse show" data-parent="#<?php consultarNombre($reg->idpermiso, 'permisos', 'id', 'nombre'); ?>">
                                    <div class="card-body">
                                        <?php

                                        $temp = $reg->idempleado_permiso;

                                        $Habilidades = mysqli_query($con, "SELECT * FROM habilidades");
                                        while ($reg = $Habilidades->fetch_object()) {
                                            $sw =  (in_array($reg->pk_hab, $skil)) ? 'checked' : 'HOLA';
                                            echo '&nbsp;<input class="'.$reg->Nombre.' "id="' . $reg->Nombre . '" ' . $sw . ' type="checkbox" style="font-size:xx-small" data-nombre="' . $reg->Nombre . '" name="Habildades[ ' . $temp . '][' . $reg->Nombre . ']" value="' . $reg->pk_hab . '" >' . $reg->Nombre . ' &nbsp;</input>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary actualizar_datos">Guardar datos</button>
                        </div>
                    </div>
                </div>

            </form>

            <!--final de los permisos -->

            <?php include "resources/footer.php" ?>
        <?php } else {
        require 'resources/acceso_prohibido.php';
    } ?>