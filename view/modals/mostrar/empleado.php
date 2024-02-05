<?php
session_start();
require_once("../../../config/config.php");
if(in_array(4,$_SESSION['Habilidad']['Empleados'])){

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $id = intval($id);
    $sql = "select * from tblcatemp where IDEMP='$id'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        while ($row = mysqli_fetch_array($query)) {
            $IDEMP = $row['IDEMP'];
            $STRNSS = $row['STRNSS'];
            $STRRFC = $row['STRRFC'];
            $STRCUR = $row['STRCUR'];
            $STRNOM = $row['STRNOM'];
            $STRAPE = $row['STRAPE'];
            $STRDOM = $row['STRDOM'];
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

            list($date, $hora) = explode(" ", $CREATE_AT);
            list($Y, $m, $d) = explode("-", $date);
            $fecha = $d . "-" . $m . "-" . $Y;


            if ($BITSUS == 1) {
                $lbl_status = "Activo";
                $lbl_class = 'label label-success';
            } else {
                $lbl_status = "Inactivo";
                $lbl_class = 'label label-danger';
            }
        }
    }
} else {
    exit;
}
?>


<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
    <input type="hidden" class="form-control" id="OLDSTRCOR" name="OLDSTRCOR" placeholder="Email: " value="<?php echo $STRCOR ?>">
    <div class="card card-primary card-outline">
        <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register" enctype="multipart/form-data">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle EverCambio" src="<?php echo $STRIMG ?>" alt="User profile picture">
                    <div class="form-group">
                        <label for="registro" class=" col-form-label">Imagen: </label>
                        
                    </div>

                </div>

                <h3 class="profile-username text-center"></h3>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="STRNSS" class=" col-form-label">NSS: </label>
                            <?php echo $STRNSS ?>
                            <span id="MSTRNSS"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="STRRFC" class=" col-form-label">RFC: </label>
                            <?php echo $STRRFC ?>
                            <span id="MSTRRFC"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="apellido" class=" col-form-label">CURP: </label>
                           <?php echo $STRCUR ?>
                            <span id="MSTRCUR"> </span>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="usuario" class=" col-form-label">Nombre: </label>
                           <?php echo $STRNOM ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="email" class=" col-form-label">Apellidos: </label>
                            <?php echo $STRAPE ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="registro" class=" col-form-label">Telefono: </label>
                            <?php echo $STRTEL ?>
                        </div>
                    </div>



                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group"> <label for="localidad" class=" col-form-label">Localidad: </label>
                           <?php echo $STRLOC ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="celular" class=" col-form-label">Estado: </label>
                           <?php echo $STREST ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="telefono" class=" col-form-label">Municipio</label>
                            <?php echo $STRMUN ?>
                        </div>
                    </div>



                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="password" class=" col-form-label">Domicilio: </label>
                           <?php echo $STRDOM ?>
                                           
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="codigo" class=" col-form-label">Codigo Postal: </label>
                            <?php echo $STRCP ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="registro" class=" col-form-label">Pais: </label>
                            <?php echo $STRPAI ?>
                        </div>
                    </div>



                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="email" class=" col-form-label">Correo Electronico: </label>
                           <?php echo $STRCOR ?>
                            <span id="MSTRCOR"> </span>
                        </div>
                    </div>
                  
                    <div class="col-4">
                        <div class="form-group">
                            <label for="bitsus" class=" col-form-label">Estatus: </label>
                            <?php 
                            if($BITSUS==1){

                            echo '<i class="far fa-check-circle"></i> Activo</span>';
                            }else{
                                echo '<span> <i class="far fa-circle"></i> Inactivo </span>';
                            }
                            ?>
                        </div>
                    </div>



                </div>


                <p class="text-muted text-center">permisos</p>


                <ul class="list-group list-group-unbordered mb-3" id="permisos">

                    <?php

                    $rspta = mysqli_query($con, "SELECT * FROM permisos");

                    $id = 0;
                    $marcados = mysqli_query($con, "SELECT * FROM empleado_permisos WHERE idempleado=$IDEMP");
                    $valores = array();
                    while ($per = $marcados->fetch_object()) {
                        array_push($valores, $per->idpermiso);
                    }
                    while ($reg = $rspta->fetch_object()) {
                        $sw = in_array($reg->id, $valores) ? 'checked' : '';

                        //echo '<li> <input id="permisos" type="checkbox" ' . $sw . '  name="permisos[]" value="' . $reg->id . '">' . $reg->nombre . '</li>';
                        echo  '  <li class="list-group-item">';
                        echo '<b>' . $reg->nombre . '</b> <a class="float-right"><input id="permisos" type="checkbox" ' . $sw . ' name="permisos[]" value="' . $reg->id . '" disabled ></a>';
                        echo '</li>';
                    }
                    ?>



                </ul>


            </div>
            <!-- /.card-body -->
    </div>

<?php  }?>