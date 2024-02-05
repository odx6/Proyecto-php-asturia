<?php
session_start();
if (in_array(1, $_SESSION['Habilidad']['Entradas'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $idempleado = $_SESSION['user_id'];
        $id = $_GET["id"];
        $id = intval($id);
        $sql = " select * from tblinv where INTIDINV='$id' and loked=1 and Editor='0' or INTIDINV='$id' and loked=0 and Editor='$idempleado';";


        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            $Editor = "UPDATE tblinv SET loked = '0',Editor = '$idempleado' WHERE INTIDINV='$id';";
            $query1 = mysqli_query($con, $Editor);
            while ($row = mysqli_fetch_array($query)) {
                $INTIDINV = $row['INTIDINV'];
                $INTIDTOP = $row['INTIDTOP'];
                $INTTIPMOV = $row['INTTIPMOV'];

                $INTFOL = $row['INTFOL'];
                $IDEMP = $row['IDEMP'];
                $STROBS = $row['STROBS'];
                $INTALM = $row['INTALM'];
                $DTEHOR = $row['DTEHOR'];
            }
        }
    } else {
        exit;
    }
?>


    <?php if ($num == 1) { ?>

        <input type="hidden" required class="form-control" id="IDEMP" name="IDEMP" placeholder="Folio:" value="<?php echo $idempleado ?>">
        <input type="hidden" required class="form-control" id="INTIDINV" name="INTIDINV" placeholder="Folio:" value="<?php echo $id ?>">

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="INTIDTOP" reuired class="col-form-label">INTIDTOP: </label>
                    <?php

                    // Consulta SQL para obtener los datos
                    $consulta = "SELECT  INTIDTOP,STRNOMTPO FROM tblcattop ORDER BY STRNOMTPO ASC";
                    $resultado = mysqli_query($con, $consulta);


                    // Crear el elemento select
                    echo ' <select class="form-control select2" name="INTIDTOP" id="INTIDTOP">';

                    if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                        // Iterar sobre los resultados y crear una opción para cada uno

                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo '<option value="' . $fila['INTIDTOP'] . '"  <?php if($INTIDTOP= $fila["INTIDTOP"]) selected ?>   ' . $fila['STRNOMTPO'] . '</option>';
                        }
                    } else {

                        echo  '<option value="" disabled  selected >No hay TBLCATTOP  bd agregue datos </option>';
                    }

                    echo '</select>';
                    ?>

                </div>


            </div>


            <div class="col-4">
                <div class="form-group">
                    <label for="INTTIPMOV" class=" col-form-label">Movimiento: </label>
                    <select class="form-control select2 col-sm-10 " name="INTTIPMOV" id="INTTIPMOVU" required>
                        <option value="1" <?php if ($INTTIPMOV == 1) echo "selected"; ?>>Entrada</option>
                        <option value="2" <?php if ($INTTIPMOV == 2) echo "selected"; ?>>Salida</option>
                    </select>
                </div>

            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="INTIDALM" reuired class="col-form-label">ALMACEN: </label>
                    <?php

                    // Consulta SQL para obtener los datos
                    $consulta = "SELECT  INTIDALM,STRNOMALM FROM tblcatalm ORDER BY STRNOMALM  ASC";
                    $resultado = mysqli_query($con, $consulta);


                    // Crear el elemento select
                    echo ' <select class="form-control " name="INTIDALM" id="INTIDALM">';

                    if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                        // Iterar sobre los resultados y crear una opción para cada uno

                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo '<option value="' . $fila['INTIDALM'] . '"  <?php if($INTIDALM= $fila["INTIDALM"]) selected ?>   ' . $fila['STRNOMALM'] . '</option>';
                        }
                    } else {

                        echo  '<option value="" disabled  selected >No hay datos de almacen en la base de datos registre nuevos </option>';
                    }

                    echo '</select>';
                    ?>

                </div>


            </div>





        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="INTFOL" class=" col-form-label">Folio: </label>
                    <input type="text" required class="form-control" id="INTFOL" name="INTFOL" placeholder="Folio: " value="<?php echo $INTFOL ?>">
                    <span id="MINTFOL"></span>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group"> <label for="STROBS" class=" col-form-label">Descripcion: </label>
                    <input type="text" required class="form-control" id="STROBS" name="STROBS" placeholder="Descripcion: " value="<?php echo $STROBS ?>">
                    <span id="STROBS"></span>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <div>
                        <label for="STRREF" class=" col-form-label">Referencia: </label>

                        <input type="text" class="form-control" id="STRREFU" name="STRREF"  placeholder="Referencia: ">
                        <span id="STRREF"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group"><label for="columna" class=" col-form-label">Buscar: </label>
                    <select class="form-control select2 col-sm-10 columnaU" name="columnaU" id="columnaU" required style="margin-bottom: 5px;">
                        <option value="STRSKU">SKU</option>
                        <option value="STRCOD">Codigo</option>
                        <option value="STRDES">Descripcion</option>

                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="INTTIPMOV" class=" col-form-label">por</label>

                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar por nombre" id="campoU" onkeyup="mostrarProductosUpdate()">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick='mostrarProductosUpdate()'><i class='fa fa-search'></i></button>
                        </span>



                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group"> <label for="INTCAN" class=" col-form-label">Cantidad</label>

                    <input type="number" class="form-control" id="INTCANU" name="INTCAN" placeholder="cantidad: ">
                    <span id="MINTCANU"></span>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="col-sm-12">
                <select multiple size="10" class="form-control" id="outproductU" style="margin-bottom: 5px;" onchange="vselect()">
                    <option disabled>Ninguna busqueda</option>
                </select>

            </div>
            <div class="cpl-sm-12 modal-footer">

                <button type="button" class="btn btn-warning" onclick="agregarUpdate()">Agregar <i class="fa fa-plus"></i></button>
            </div>

        </div>


     


            
                <table class="table table-hover text-nowrap" id="miTablaUpdate"  whith="30%">
                    <caption>Productos Agregados</caption>
                    <thead>
                        <tr>
                            <th scope="col">Indice</th>
                            <th scope="col">SKU</th>
                            <th scope="col">ref.</th>
                            <th scope="col">cant.</th>
                            <th scope="col">pre.</th>
                            <th scope="col">tot./u</th>
                            <th scope="col">Accion</th>

                        </tr>
                    </thead>
                    <tbody>



                    </tbody>
                </table>

        
            <div class="row">
                <div class="col-6">
                    <label for="MONCTOPRO" class=" col-form-label">Total</label>
                    <input type="number" required class="form-control static" id="MONCTOPROU" name="MONCTOPRO" placeholder="Total: " readonly>
                </div>
                <div class="col-6">
                <label for="Count" class=" col-form-label">Total de productos</label>
                <input type="number" required class="form-control static" id="CountU" name="CountU" placeholder="Total: " readonly>
                </div>

            </div>
          
            





        </div>
    <?php } else {

        echo 'Error';
    } ?>
<?php } ?>