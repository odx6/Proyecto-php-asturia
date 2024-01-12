<?php
session_start();
require_once("../../../config/config.php");
require_once("../../../config/funciones.php");
if (in_array(4, $_SESSION['Habilidad']['Productos'])) {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        $sql = "select * from tblcatpro where STRSKU='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            $rw = mysqli_fetch_array($query);
            $SKU = $rw['STRSKU'];
            $STRCODINT = $rw['STRCOD'];
            //$nombre=$rw['nombre'];
            $STRDESPRO = $rw['STRDESPRO'];
            $INTIDCAT = $rw['INTIDCAT'];

            $INTIDSUBCAT = $rw['INTIDSBC'];
            $MONPCOS = $rw['MONPCOS'];
            $INTIDUNI = $rw['INTIDUNI'];
            $STRIMG = $rw['STRIMG'];
            $INTTIPUSO = $rw['INTTIPUSO'];
            $BITSUS = $rw['BITSUS'];
            $CREATE_AT = $rw['CREATE_AT'];
            if ($BITSUS == 1) {
                $lbl_status = "Activo";
                $lbl_class = 'label label-success';
            } else {
                $lbl_status = "Inactivo";
                $lbl_class = 'label label-danger';
            }
        }
    } else {
        exit;
    }
?>



    <br>
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
    <div class="form-group">

        <div class="col-sm-6">
            <label for="dni" class=" control-label">SKU: </label>
            <input type="text" readonly class="form-control" id="sku" name="sku" value="<?php echo $SKU; ?>" placeholder="SKU: ">
        </div>


        <div class="col-sm-6">
            <label for="nombre" class=" control-label">Codigo: </label>
            <input type="text" readonly class="form-control" id="codigo" name="codigo" value="<?php echo $STRCODINT; ?>" placeholder="Codigo: ">
        </div>
    </div>

    <div class="form-group">

        <div class="col-sm-12">
            <label for="apellido" class="control-label">Descripcion: </label>
            <input type="text" readonly class="form-control" id="descripcion" name="descripcion" value="<?php echo $STRDESPRO; ?>" placeholder="Descripcion: ">
        </div>
    </div>
    <div class="card mb-3" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="<?php echo $STRIMG ?>" class="img-fluid rounded-start EverCambio" alt="...">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <!--empieza la card body-->
                    <div class="form-group">

                        <div class="col-sm-6">

                            <label for="imagefile" class="col-sm-2 control-label">Imagen: </label>
                            <input type="text" readonly name="STRIMG" class="form-control " id="STRIMG" value="imagen" readonly>
                        </div>


                        <div class="col-sm-6">
                            <label for="usuario" class="control-label">Categoria: </label>

                            <input type="text" required class="form-control" id="precio" readonly name="precio" placeholder="Precio" pattern="\d+" title="Por favor ingresa solo números positivos" required value="<?php consultarNombre($INTIDCAT, 'tblcatcat', 'INTIDCAT', 'STRNOMCAT'); ?>">

                        </div>
                    </div>


                    <div class="form-group">

                        <div class="col-sm-6">
                            <label for="subcategoria" class=" control-label">Subcategoria: </label>
                            <input type="text" class="form-control" value="<?php consultarNombre($INTIDSUBCAT, 'tblcatsbc', 'INTIDSBC', 'STRNOMSBC'); ?>" readonly>
                        </div>


                        <div class="col-sm-6">
                            <label for="precio" class=" control-label">Precio: </label>
                            <input type="text" required class="form-control" id="precio" name="precio" placeholder="Precio" pattern="\d+" title="Por favor ingresa solo números positivos" required value="<?php echo "$" . number_format($MONPCOS, 2, '.', ','); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-sm-6">
                            <label for="usuario" reuired class=" control-label"> Medida : </label>

                            <input type="text" class="form-control" value="<?php consultarNombre($INTIDUNI, 'tblcatuni', 'INTIDUNI', 'STRNOMUNI'); ?> " readonly>



                        </div>



                        <div class="col-sm-6">
                            <label for="usuario" reuired class="control-label">Tipo de uso: </label>

                            <input type="text" class="form-control" value="<?php consultarNombre($INTTIPUSO, 'tblcattus', 'INTIDPUSO', 'STRNOMPUSO'); ?>" readonly>




                        </div>
                    </div>



                    <div class="form-group">

                        <div class="col-sm-12">
                            <label for="estado" class=" control-label">Estado: </label>
                            <select readonly class="form-control" name="estado" id="estado" required>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <!--- end card body-->
                </div>
            </div>
        </div>
    </div>
<?php } ?>