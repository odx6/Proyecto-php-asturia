<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['Solicitud'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from solicitud where pk_solicitud='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            $rw = mysqli_fetch_array($query);
            $pk_solicitud = $rw['pk_solicitud'];
            $fk_empleado = $rw['fk_empleado'];

            //Name empleado 
            if (isset($fk_empleado) && $fk_empleado != NULL) {
                $Empleado = mysqli_query($con, "SELECT * FROM tblcatemp WHERE IDEMP='$fk_empleado'");
                $tem = mysqli_fetch_array($Empleado);
                $NombreEmpleado = $tem['STRNOM'] . " " . $tem['STRAPE'];
            }
            //
            $NumeroFolio = $rw['NumeroFolio'];
            $fecha = $rw['fecha'];
            $operador = $rw['operador'];
            $NoCarro = $rw['NoCarro'];
            $Kilometraje = $rw['Kilometraje'];
            $NoPlacas = $rw['NoPlacas'];
            $DetallesServicio = $rw['DetallesServicio'];
            $Observaciones = $rw['Observaciones'];
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
    <div class="form-group">
        <label for="dni" class="col-sm-2 control-label">Id Orden: </label>
        <div class="col-sm-10">
            <input type="text" required class="form-control" id="pk_solicitud" name="pk_solicitud" value="<?php echo $pk_solicitud; ?>" placeholder="Id Orden: ">
        </div>
    </div>
    <div class="form-group">
        <label for="nombre" class="col-sm-2 control-label">Empleado: </label>
        <div class="col-sm-10">
            <input type="text" required class="form-control" id="fk_empleado" name="fk_empleado" value="<?php echo $fk_empleado; ?>" placeholder="<?php echo $NombreEmpleado; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="apellido" class="col-sm-2 control-label">Número de Folio: </label>
        <div class="col-sm-10">
            <input type="text" required class="form-control" id="NumeroFolio" name="NumeroFolio" value="<?php echo $NumeroFolio; ?>" placeholder="Número Folio: ">
        </div>
    </div>
    <div class="form-group">
        <label for="usuario" class="col-sm-2 control-label">Fecha: </label>
        <div class="col-sm-10">
            <input type="text" required class="form-control" id="fecha" name="fecha" value="<?php echo $fecha; ?>" placeholder="Fecha: ">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Operador: </label>
        <div class="col-sm-10">
            <input type="text" required class="form-control" id="operador" name="operador" value="<?php echo $operador; ?>" placeholder="Operador: ">
        </div>
    </div>

    <div class="form-group">
        <label for="domicilio" class="col-sm-2 control-label">No. de carro: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="NoCarro" name="NoCarro" value="<?php echo $NoCarro; ?>" placeholder="No.de Carro: ">
        </div>
    </div>
    <div class="form-group">
        <label for="localidad" class="col-sm-2 control-label">Kilometraje: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Kilometraje" name="Kilometraje" value="<?php echo $Kilometraje; ?>" placeholder="Kilometraje: ">
        </div>
    </div>
    <div class="form-group">
        <label for="telefono" class="col-sm-2 control-label">No.Placas</label>
        <div class="col-sm-10">
            <input type="text" required class="form-control" id="NoPlacas" name="NoPlacas" value="<?php echo $NoPlacas; ?>" placeholder="No.Placas">
        </div>
    </div>
    <div class="form-group">
        <label for="celular" class="col-sm-2 control-label">Detalles Del Servicio : </label>
        <div class="col-sm-10">
            <input type="text" required class="form-control" id="DetallesServicio" name="DetallesServicio" value="<?php echo $DetallesServicio; ?>" placeholder="Detalles: ">
        </div>
    </div>
    <div class="form-group">
        <label for="registro" class="col-sm-2 control-label">Observaciones: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Observaciones" name="Observaciones" value="<?php echo $Observaciones; ?>" placeholder="Observaciones: ">
        </div>
    </div>



<?php } ?>