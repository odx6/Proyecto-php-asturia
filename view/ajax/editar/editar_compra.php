<?php
//require './vendor/autoload.php';
require '../../../vendor/autoload.php';
session_start();
$json_data = $_POST['inventario'];

// Decodificar los datos JSON
$datos = json_decode($json_data, true);
function  SeEncuentra($dato, $arrays)
{
    //Esta funcion busca en un arreglo si se encuentra el valor proporcionado
    $flag = false;

    foreach ($arrays as $array) {


        if (in_array($dato, $array))  $flag = true;
    }
    return $flag;
}




$gump = new GUMP();

$gump->validation_rules([
    'IDEMP'    => 'required|numeric',
    'PK_COMPRA'    => 'required|numeric',
    'FK_PROVE'    => 'required|numeric',
    'STREMI'       => 'required|alpha_numeric|min_len,10',
    'STRFACTURA'      => 'required|numeric',
    'DTHORFAG' => 'required',
    'DTHORPAG' => 'required',
    'INTIDALM' => 'required|numeric',
    'inventario' => 'required'
]);

$gump->set_fields_error_messages([
    'PK_COMPRA'      => [
        'required' => 'Numero de compra necesaria es requerido',
        'numeric' => 'El numero de compra debe  ser numerico'

    ],
    'IDEMP'      => [
        'required' => 'El campo marca es requerido',
        'numeric' => 'El id de empleado debe ser numerico'

    ],
    'FK_PROVE'   => [
        'required' => 'El campo de proveedor no puede estar vacio',
        'min_len' => 'El minimo de caracteres para modelo es 3'
    ],
    'STREMI'   => [
        'required' => 'El campo de remision no puede estar vacio',
        'min_len' => 'El minimo de caracteres para remision es 10',
        'alpha_numeric' => 'El campo remision debe ser alfanumerico'
    ],
    'STRFACTURA'   => [
        'required' => 'El campo de factura no puede estar vacio',
        'numeric' => 'El minimo de caracteres para factura es 10'
    ],
    'DTHORFAG'   => [
        'required' => 'El campo de fecha de la factura no puede estar vacio',

    ],
    'DTHORPAG'   => [
        'required' => 'El campo de fecha de pago no puede estar vacio'

    ],
    'inventario'   => [
        'required' => 'El no se puede crear una compra sin productos'


    ],
    'INTIDALM'   => [
        'required' => 'El camp almacen no puede estar vacio'


    ],





]);
$gump->filter_rules([
    'IDEMP' => 'trim|sanitize_string',
    'FK_PROVE' => 'trim|sanitize_string',
    'STREMI' => 'trim|sanitize_string'

]);
$valid_data = $gump->run($_POST);

?>
<?php
if ($gump->errors()) {
?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        $array = $gump->get_readable_errors();
        foreach ($array as $error) {
            echo $error . "<br>";
        }
        ?>
    </div>

    <?php


} else {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once("../../../config/RecuperarDatos.php");
    if (is_array($datos) && count($datos) > 0) {

        $PK_COMPRA = mysqli_real_escape_string($con, (strip_tags($valid_data["PK_COMPRA"], ENT_QUOTES)));
        $IDEMP = mysqli_real_escape_string($con, (strip_tags($valid_data["IDEMP"], ENT_QUOTES)));
        $FK_PROVE = mysqli_real_escape_string($con, (strip_tags($valid_data["FK_PROVE"], ENT_QUOTES)));
        $STREMI = mysqli_real_escape_string($con, (strip_tags($valid_data["STREMI"], ENT_QUOTES)));
        $STRFACTURA = mysqli_real_escape_string($con, (strip_tags($valid_data["STRFACTURA"], ENT_QUOTES)));
        $DTHORFAG = mysqli_real_escape_string($con, (strip_tags($valid_data["DTHORFAG"], ENT_QUOTES)));
        $DTHORPAG = mysqli_real_escape_string($con, (strip_tags($valid_data["DTHORPAG"], ENT_QUOTES)));
        $INTIDALM = mysqli_real_escape_string($con, (strip_tags($valid_data["INTIDALM"], ENT_QUOTES)));

        $DTEHOR = date("Y-m-d H:i:s");

        try {

            // $fechaFactura = DateTime::createFromFormat('m/d/Y', $DTHORFAG);
            //  $fechaPago = DateTime::createFromFormat('m/d/Y', $DTHORPAG);
            //$fechaFactura->format('Y-m-d')
            $olddata = recuperarDatos("SELECT * from tblcom WHERE PK_COMPRA='$PK_COMPRA';");
            $Update = "UPDATE `tblcom` SET  `FK_PROVE`='" . $FK_PROVE . "',`FK_ALMACEN`='" . $INTIDALM . "',`FK_EMP`='" . $IDEMP . "',`STREMI`='" . $STREMI . "',`STRFACTURA`='" . $STRFACTURA . "',`DTHORFAC`='" . $DTHORFAG  . "',`DTHORPAG`='" . $DTHORPAG . "'  WHERE  PK_COMPRA='$PK_COMPRA'";
            $query_update = mysqli_query($con, $Update);
            if ($query_update) {
                try {

                    //Eliminar los datos que ya no estan  
                    $sql2 = "SELECT * FROM `tbldetcom`  WHERE FK_COM='$PK_COMPRA' ORDER BY  PK_DETCOM   ASC;";
                    $query_new1 = mysqli_query($con, $sql2);
                    if (isset($query_new1) && $query_new1 != NULL &&  mysqli_num_rows($query_new1) > 0) {

                        // Iterar sobre los resultados y crear una opción para cada uno

                        while ($fila = mysqli_fetch_assoc($query_new1)) {

                            //tiene que buscar uno por uno para no eliminarlo

                            $inventario = $fila['FK_COM'];
                            $producto = $fila['FK_SKU'];

                            if (SeEncuentra($fila['PK_DETCOM'], $datos) == 1) {
                            } else {
                                $identificador = $fila['PK_DETCOM'];
                                $deletevalue = recuperarDatos("SELECT * from tbldetcom WHERE PK_DETCOM='$identificador';");
                                $sql3 = "DELETE FROM `tbldetcom` WHERE PK_DETCOM='$identificador';";
                                $query_new2 = mysqli_query($con, $sql3);

                                if ($query_new2) {

                                    //eliminar la tarjeta 
                                    $deletetar = recuperarDatos("SELECT * from tbltarinv where INTIDINV='" . $inventario . "' and SKU='" . $producto . "' and INTTIPMOV='3' ;");


                                    $sqldeletetar = "DELETE FROM tbltarinv  where INTIDINV=" . $inventario . " and SKU='" . $producto . "' and INTTIPMOV='3' ;";
                                    $querydelete = mysqli_query($con, $sqldeletetar);
                                    if ($querydelete) {
                                        $tabla = "tbltarinv";
                                        $tipo = "Eliminacion";
                                        $fecha = date("Y-m-d H:i:s");

                                        $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $identificador . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $deletetar . "');";
                                        $query = mysqli_query($con, $sqllog);
                                        ($query) ? $messages[] = "Se creo el log de tarjeta detalle-compra compra " : $errors[] = "no se pudo generar el registro de detalle compra";
                                    }

                                    //

                                    $tabla = "tbldetcom";
                                    $tipo = "Eliminacion";
                                    $fecha = date("Y-m-d H:i:s");

                                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $identificador . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $deletevalue . "');";
                                    $query = mysqli_query($con, $sqllog);

                                    //Eliminar Tarjeta del detalle 


                                    //



                                } else {

                                    $errors[] = "No  se pudo crear el log para el dato" . $PK_COMPRA;
                                }
                            }
                        }
                    }
                    //end termina de eleiminar

                    if (is_array($datos)) {
                        //comiensa foreach


                        //filtros para productos nuevos 
                        $Pronuevos = array_filter($datos, function ($item) {
                            return !array_key_exists('PK_DETCOM', $item);
                        });
                        $UpdateProductos = array_filter($datos, function ($item) {
                            return array_key_exists('PK_DETCOM', $item);
                        });

                        // filtro para podructos viejos


                        if (count($Pronuevos) > 0) {

                            foreach ($Pronuevos as $elemento) {


                                $SQL = "INSERT INTO `tbldetcom`( `FK_COM`,`FK_SKU`, `INTCANT`, `FK_UNI`, `PCRCOST`, `PCRCOSTANTE`, `TOTAL`, `DTHOR`) 
                                VALUES ('" . $PK_COMPRA . "','" . $elemento["FK_SKU"] . "','" . $elemento["INTCANT"] . "','" . $elemento["INTIDUNI"] . "','" . $elemento["PCRCOST"] . "','" . $elemento["MONPRCOS"] . "','" . $elemento["TOTAL"] . "','" . $DTEHOR . "')";
                                $insert_com = mysqli_query($con, $SQL);

                                $id_insert_compra = mysqli_insert_id($con);


                                if ($insert_com) {

                                    //agregar la tarjeta de la compra 
                                    $date = date("Y-m-d");
                                    $sqlinserttar = "INSERT INTO `tbltarinv`( `INTIDINV`, `DTEFEC`, `SKU`,  `INTCAN`, `INTIDUNI`, `MONPRCOS`, `MONCTOPRO`, `INTTIPMOV`, `INTALM`, `DTEHOR`) VALUES
                                       ('" . $PK_COMPRA . "','" . $date . "','" . $elemento["FK_SKU"] . "','" . $elemento["INTCANT"] . "','" . $elemento["INTIDUNI"] . "','" . $elemento["PCRCOST"] . "','" . $elemento["MONCTOPRO"] . "','3','" . $INTIDALM . "','" . $DTEHOR . "')";
                                    $queryinserttar = mysqli_query($con, $sqlinserttar);

                                    if ($queryinserttar) {
                                        $id =  mysqli_insert_id($con);
                                        $sql2 = recuperarDatos("SELECT * from tbltarinv WHERE INTIDTAR='$id';");
                                        $tabla = "tbltarinv";
                                        $tipo = "creacion";
                                        $fecha = date("Y-m-d H:i:s");

                                        $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
                                        $query = mysqli_query($con, $sqllog);

                                        ($query) ? $messages[] = "Se creo el log de detalle compra " : $errors[] = "algo salio mal al crear el log detalle compra";
                                    } else {
                                        $errors[] = " no se pudo crear el log de la tarjeta: " . $elemento["FK_SKU"];
                                    }

                                    //
                                    $messages[] = "Se agrego la detalle compra";
                                    $id =  $id_insert_compra;
                                    $sql2 = recuperarDatos("SELECT * from tbldetcom WHERE PK_DETCOM='$id';");
                                    $tabla = "tbldetcom";
                                    $tipo = "creacion";
                                    $fecha = date("Y-m-d H:i:s");

                                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
                                    $query = mysqli_query($con, $sqllog);

                                    ($query) ? $messages[] = "Se creo el log de detalle compra " : $errors[] = "algo salio mal al crear el log detalle compra";
                                } else {
                                    $errors[] = " no se pudo agregar el detallecompra de : " . $elemento["FK_SKU"];
                                }
                            }

                            //termina foreach 
                        }

                        //Actualizar productos en existencia 
                        if (count($UpdateProductos) > 0) {

                            foreach ($UpdateProductos as $elemento) {

                                $olddata = recuperarDatos("SELECT * from tbldetcom WHERE PK_DETCOM='" . $elemento['PK_DETCOM'] . "';");
                                $total = $elemento['PCRCOST'] * $elemento['INTCANT'];
                                $sql_update = "UPDATE `tbldetcom` SET `INTCANT`='" . $elemento["INTCANT"] . "',`PCRCOST`='" . $elemento["PCRCOST"] . "',`TOTAL`='" . $total . "' WHERE PK_DETCOM='" . $elemento['PK_DETCOM'] . "'";
                                $insert_com = mysqli_query($con, $sql_update);


                                if ($insert_com) {

                                    // actualizacion de la tarjeta de laq compra 
                                    $updateCom = "UPDATE `tbltarinv` SET `INTCAN`='" . $elemento["INTCANT"] . "',`MONPRCOS`='" . $elemento['PCRCOST'] . "',`MONCTOPRO`='" . $total . "'  WHERE INTIDINV='" . $PK_COMPRA . "' AND SKU='" . $elemento['FK_SKU'] . "' AND INTTIPMOV=3;";
                                    $query_update = mysqli_query($con, $updateCom);

                                    if ($query_update) {
                                        $messages[] = "Se actualizo la tarjeta de detalle compra";
                                         $sqlide="SELECT INTIDTAR FROM tbltarinv WHERE INTIDINV='".$PK_COMPRA."' AND SKU='". $elemento['FK_SKU']."' AND INTTIPMOV=3;";
                                         $ide=mysqli_query($con,$sqlide);
                                         $tem = mysqli_fetch_array($ide);

                                        $id =$tem['INTIDTAR'];
                                        $sql2 = recuperarDatos("SELECT * from tbltarinv WHERE INTIDTAR='$id';");
                                        $tabla = "tbltarinv";
                                        $tipo = "Actualizacion";
                                        $fecha = date("Y-m-d H:i:s");

                                        $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $olddata . "','" . $sql2 . "');";
                                        $query = mysqli_query($con, $sqllog);

                                        ($query) ? $messages[] = "Se creo el log de  actualizacion de  la tarjeta de detalle compra " : $errors[] = "algo salio mal al intentar actualizar la tarjeta detalle compra";
                                    } else {
                                    }
                                    //end actualizacion de la tarjeta 
                                    $messages[] = "Se Actualizo el detalle compra";
                                    $id =  $elemento['PK_DETCOM'];
                                    $sql2 = recuperarDatos("SELECT * from tbldetcom WHERE PK_DETCOM='$id';");
                                    $tabla = "tbldetcom";
                                    $tipo = "Actualizacion";
                                    $fecha = date("Y-m-d H:i:s");

                                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $olddata . "','" . $sql2 . "');";
                                    $query = mysqli_query($con, $sqllog);

                                    ($query) ? $messages[] = "Se creo el log de detalle actualizacion de compra " : $errors[] = "algo salio mal al crear el log de actualizacion de  detalle compra";
                                } else {
                                    $errors[] = " no se pudo agregar el detallecompra de : " . $elemento["FK_SKU"];
                                }
                            }

                            //termina foreach 
                        }

                        //





                    } else {
                        $errors[] = "No se puede crear una compra sin productos";
                    }
                } catch (mysqli_sql_exception $e) {
                    $errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
                }
                $messages[] = "Se Actualizo  la compra";

                $sql2 = recuperarDatos("SELECT * from tblcom WHERE PK_COMPRA='$PK_COMPRA';");
                $tabla = "tblcom";
                $tipo = "Actualizacion";
                $fecha = date("Y-m-d H:i:s");

                $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $PK_COMPRA . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
                $query = mysqli_query($con, $sqllog);

                ($query) ? $messages[] = "Se creo el log de resgistro de la compra" : $errors[] = "algo salio mal al crear el resgistro de la compra";
            } else {

                $errors[] = "No se pudo agregar la actualizar la compra";
            }
        } catch (mysqli_sql_exception $e) {

            $errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
        }
    } else {
        $errors[] = "No se puede crear una compra sin productos";
    }




    if (isset($errors)) {

    ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong>
            <?php
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
            ?>
        </div>
    <?php
    }
    if (isset($messages)) {

    ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Bien hecho!</strong>
            <?php
            foreach ($messages as $message) {
                echo $message . "<br>";
            }
            ?>
        </div>
<?php
    }
}
?>