<?php

if (in_array(4, $_SESSION['Habilidad']['Categorias'])) {


    require_once("./config/config.php");
    require_once("./config/funciones.php");

    $sql = "SELECT * FROM tblcatpro;";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);

    if ($num > 0) {
?>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Productos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Productos</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example4" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Opcion</th>
                                                    <th>SKU</th>
                                                    <th>codigo</th>
                                                    <th>Descripcion</th>
                                                    <th>Imagen</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $finales = 0;

                                                while ($row = mysqli_fetch_array($query)) {
                                                    $sku = $row['STRSKU'];
                                                    $codigo = $row['STRCOD'];
                                                    $descripcion = $row['STRDESPRO'];

                                                    $status = $row['BITSUS'];
                                                    $INTIDCAT = $row['INTIDCAT'];
                                                    //cONSULTA PARA SACAR LA CATEGORIA
                                                    if (isset($INTIDCAT) && $INTIDCAT != NULL) {
                                                        $Categoria = mysqli_query($con, "SELECT * FROM tblcatcat WHERE  INTIDCAT='$INTIDCAT'");
                                                        if (isset($Categoria) && $Categoria != NULL) {
                                                            $tem = mysqli_fetch_array($Categoria);
                                                            if (isset($tem) && $tem != NULL) $NombreCategoria = $tem['STRNOMCAT'];
                                                        }
                                                    }
                                                    //ENDCONSULTA


                                                    $INTIDSBC = $row['INTIDSBC'];
                                                    if (isset($INTIDSBC) && $INTIDSBC != NULL) {
                                                        $Subcategoria = mysqli_query($con, "SELECT * FROM  tblcatsbc WHERE INTIDSBC='$INTIDSBC'");

                                                        if (isset($Subcategoria) && $Subcategoria != NULL) {
                                                            $tem = mysqli_fetch_array($Subcategoria);
                                                            if (isset($tem) && $tem != NULL) $SubcategoriaNombre = $tem['STRNOMSBC'];
                                                        }
                                                    }
                                                    $MONPCOS = $row['MONPCOS'];
                                                    $INTIDUNI = $row['INTIDUNI'];
                                                    $STRIMG = $row['STRIMG'];

                                                    $INTTIPUSO = $row['INTTIPUSO'];



                                                    /*$kind=$row['kind'];*/

                                                    $finales++;
                                                ?>
                                                    <tr>
                                                        <td> <button class="btn btn-primary" onclick="Agregar('<?php echo  $sku ?>','<?php echo $MONPCOS ?>','<?php echo $descripcion?>','<?php echo $INTIDUNI?>')"> <i class="fa fa-plus"></i></button></td>
                                                        <td><?php echo $sku ?></td>
                                                        <td><?php echo $codigo ?></td>
                                                        <td><?php echo $descripcion ?></td>
                                                        <td>
                                                            <div>
                                                                <img width="50px" height="50px" src="<?php echo $STRIMG ?>" alt="Imagen Producto">
                                                            </div>
                                                        </td>





                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Opcion</th>
                                                    <th>SKU</th>
                                                    <th>codigo</th>
                                                    <th>Descripcion</th>
                                                    <th>Imagen</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>








                        <!--end modal -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                       
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
<?php }
} ?>