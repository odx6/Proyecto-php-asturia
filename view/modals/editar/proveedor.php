<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['proveedores'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcatprov where pk_prov='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {
                $pk_prov = $row["pk_prov"];
                $STRRFC = $row["STRRFC"];
                $STRNOM = $row["STRNOM"];
                $STRDOM = $row["STRDOM"];
                $STRTEL = $row["STRTEL"];
                $STRNUMCUN = $row["STRNUMCUN"];
                $STRNOMBAN = $row["STRNOMBAN"];
                $STRCOR = $row["STRCOR"];
                $STRCONT = $row["STRCONT"];
                $BITSUS = $row["BITSUS"];
                $DTHOR = $row["DTHOR"];
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $pk_prov ?>" id="id" name="id" require>
    <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="RFC" class=" col-form-label">RFC: </label>
                                    <input type="text" required class="form-control" id="STRRFC" name="STRRFC" placeholder="RFC: " value="<?php echo $STRRFC?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group"> <label for="Nombre" class=" col-form-label">Nombre: </label>
                                    <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="Nombre: " value="<?php echo $STRNOM?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="Domicilio" class=" col-form-label">Domicilio: </label>
                                    <input type="text" required class="form-control" id="STRDOM" name="STRDOM" placeholder="Domicilio: " value="<?php echo $STRDOM?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group"><label for="Telefono" class=" col-form-label">Telefono: </label>
                                    <input type="text" required class="form-control" id="STRTEL" name="STRTEL" placeholder="Telefono" value="<?php echo $STRTEL?>">
                                </div>
                            </div>
                            <div class="col-4">


                                <div class="form-group">
                                    <label for="STRNUMCUN" class=" col-form-label">Numero de cuenta: </label>
                                    <input type="text" required class="form-control" id="STRNUMCUN" name="STRNUMCUN" placeholder="STRNUMCUN:" value="<?php  echo $STRNUMCUN ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group"><label for="STRNOMBAN" class=" col-form-label">Nombre del banco: </label>
                                    <input type="text" required class="form-control" id="STRNOMBAN" name="STRNOMBAN" placeholder="nombre del banco: " value="<?php echo $STRNOMBAN ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                <label for="STRCONT" class=" col-form-label">Contacto: </label>
                                    <input type="text" required class="form-control" id="STRCONT" name="STRCONT" placeholder="contacto: " value="<?php echo $STRCONT?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group"><label for="STRCOR" class=" col-form-label">email: </label>
                                    <input type="email" required class="form-control" id="STRCOR" name="STRCOR" placeholder="correo electronico: " value="<?php echo $STRCOR?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                <label for="estado" class="col-form-label">Estado: </label>
                                <select class="form-control select2" name="BITSUS" id="BITSUS">
                                    <option value="1" <?php if($BITSUS==1) echo "selected"?>>Activo</option>
                                    <option value="2" <?php if($BITSUS==2) echo "selected"?> >Inactivo</option>
                                </select>
                                </div>
                            </div>
                            <?php } ?>