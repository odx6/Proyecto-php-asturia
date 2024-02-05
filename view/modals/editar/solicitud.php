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
    <input type="hidden" required class="form-control" id="fk_empleado" name="fk_empleado" placeholder="EMPLEADO: " value="<?php if (isset($fk_empleado)) echo   $fk_empleado ?>">
    <input type="hidden" required class="form-control" id="fecha" name="fecha" placeholder="fecha: " value="<?php
echo date('Y-m-d H:i:s');
?>">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="sku" class="col-sm-2 control-label"> Orden: </label>
                                <input type="text" required class="form-control" id="pk_solicitud" name="pk_solicitud" placeholder="Id de Orden: " value="<?php echo $pk_solicitud?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="sku" class="col-sm-2 control-label">No.Folio: </label>
                                <input type="text" required class="form-control" id="NumeroFolio" name="NumeroFolio" placeholder="NumeroFolio: " value="<?php echo $NumeroFolio?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="codigo" class="col-sm-2 control-label">operador: </label>
                                <input type="text" required class="form-control" id="operador" name="operador" placeholder="operador: " value="<?php echo $operador?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="descripcion" class="col-sm-2 control-label">No.NoCarro: </label>
                                <input type="text" required class="form-control" id="NoCarro" name="NoCarro" placeholder="No.NoCarro: " value="<?php echo $NoCarro?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="categoria" class="col-sm-2 control-label">Kilometraje: </label>
                                <input type="text" required class="form-control" id="Kilometraje" name="Kilometraje" placeholder="Kilometraje: " value="<?php echo $Kilometraje?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="subcategoria" class="col-sm-2 control-label">No.placas: </label>
                                <input type="text" required class="form-control" id="NoPlacas" name="NoPlacas" placeholder="NoPlacas: " value="<?php echo $NoPlacas?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="precio" class="col-sm-2 control-label">DetallesServicio: </label>
                                <input type="text" required class="form-control" id="DetallesServicio" name="DetallesServicio" placeholder="DetallesServicio" value="<?php echo $DetallesServicio?>">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="unidad" class="col-sm-2 control-label">Observaciones: </label>
                                <input type="text" class="form-control" id="Observaciones" name="Observaciones" placeholder="Observaciones: " value="<?php echo $Observaciones?>">
                            </div>
                        </div>
                    </div>



<?php } ?>