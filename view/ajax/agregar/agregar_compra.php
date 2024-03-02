<?php
//require './vendor/autoload.php';
require '../../../vendor/autoload.php';
session_start();
$json_data = $_POST['inventario'];

// Decodificar los datos JSON
$datos = json_decode($json_data, true);


$gump = new GUMP();

$gump->validation_rules([
    'IDEMP'    => 'required|numeric',
    'FK_PROVE'    => 'required|numeric',
    'INTIDALM'    => 'required|numeric',
    'STREMI'       => 'required|alpha_numeric|min_len,10',
    'STRFACTURA'      => 'required|numeric',
    'DTHORFAG' => 'required',
    'DTHORPAG' => 'required',
    'inventario' => 'required'
]);

$gump->set_fields_error_messages([
    'IDEMP'      => [
        'required' => 'El campo marca es requerido',
        'numeric' => 'El id de empleado debe ser numerico'

    ],
    'FK_PROVE'   => [
        'required' => 'El campo de proveedor no puede estar vacio',
        'min_len' => 'El minimo de caracteres para modelo es 3'
    ],
    'INTIDALM'   => [
        'required' => 'El campo de ALMACEN no puede estar vacio',
        'numeric' => 'El tipo debe ser numerico'
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

        $IDEMP = mysqli_real_escape_string($con, (strip_tags($valid_data["IDEMP"], ENT_QUOTES)));
        $FK_PROVE = mysqli_real_escape_string($con, (strip_tags($valid_data["FK_PROVE"], ENT_QUOTES)));
        $INTIDALM = mysqli_real_escape_string($con, (strip_tags($valid_data["INTIDALM"], ENT_QUOTES)));
        $STREMI = mysqli_real_escape_string($con, (strip_tags($valid_data["STREMI"], ENT_QUOTES)));
        $STRFACTURA = mysqli_real_escape_string($con, (strip_tags($valid_data["STRFACTURA"], ENT_QUOTES)));
        $DTHORFAG = mysqli_real_escape_string($con, (strip_tags($valid_data["DTHORFAG"], ENT_QUOTES)));
        $DTHORPAG = mysqli_real_escape_string($con, (strip_tags($valid_data["DTHORPAG"], ENT_QUOTES)));

        $DTEHOR = date("Y-m-d H:i:s");
        $date = date("Y-m-d");

        try {

            $fechaFactura = DateTime::createFromFormat('m/d/Y', $DTHORFAG);
            $fechaPago = DateTime::createFromFormat('m/d/Y', $DTHORPAG);


            $insert = "INSERT INTO `tblcom`(`FK_PROVE`, `FK_EMP`, `FK_ALMACEN`, `STREMI`, `STRFACTURA`, `DTHORFAC`, `DTHORPAG`, `DTHOR`)
             VALUES ('" . $FK_PROVE . "','" . $IDEMP . "','" . $INTIDALM  . "','" . $STREMI . "','" . $STRFACTURA . "','" . $fechaFactura->format('Y-m-d') . "','" . $fechaPago->format('Y-m-d') . "','" . $DTEHOR . "' )";
            $query_insert = mysqli_query($con, $insert);
            if ($query_insert) {
                $id_insertado = mysqli_insert_id($con);


                try {
                    if (is_array($datos)) {
                        //comiensa foreach
                        foreach ($datos as $elemento) {


                            $SQL = "INSERT INTO `tbldetcom`( `FK_COM`, `FK_SKU`, `INTCANT`, `FK_UNI`, `PCRCOST`, `PCRCOSTANTE`, `TOTAL`, `DTHOR`) 
                        VALUES ('" . $id_insertado . "','" . $elemento["FK_SKU"] . "','" . $elemento["INTCANT"] . "','" . $elemento["INTIDUNI"] . "','" . $elemento["PCRCOST"] . "','" . $elemento["MONPRCOS"] . "','" . $elemento["MONCTOPRO"] . "','" . $DTEHOR . "')";
                            $insert_com = mysqli_query($con, $SQL);




                            if ($insert_com) {
                                $id_det_com=mysqli_insert_id($con);

                                //agregar ala tarjeta 
                                $insert_tar = "INSERT INTO `tbltarinv`(`INTIDINV`, `DTEFEC`, `SKU`,  `INTCAN`, `INTIDUNI`, `MONPRCOS`, `MONCTOPRO`, `INTTIPMOV`, `INTALM`, `DTEHOR`) 
                                VALUES ('" . $id_insertado . "','" . $date . "','" . $elemento['FK_SKU'] . "','" . $elemento["INTCANT"] . "','" . $elemento["INTIDUNI"] . "','" . $elemento["PCRCOST"] . "','" . $elemento["MONCTOPRO"] . "','3','" . $INTIDALM . "','" . $DTEHOR . "')";
                                $querytar = mysqli_query($con, $insert_tar);
                                if ($querytar) {
                                    $id =  mysqli_insert_id($con);
                                    $sql2 = recuperarDatos("SELECT * from tbltarinv WHERE INTIDTAR='$id';");
                                    $tabla = "tbltarinv";
                                    $tipo = "creacion";
                                    $fecha = date("Y-m-d H:i:s");

                                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
                                    $query = mysqli_query($con, $sqllog);

                                    ($query) ? $messages[] = "Se creo el log de tarjeta de  compra " : $errors[] = "algo salio mal al crear el log tarjeta compra";
                                } else {
                                    $errors[] = " no se pudo agregar el la tarjeta  de : " . $elemento["FK_SKU"];
                                }

                                //end agregar a la tarjeta 
                                $messages[] = "Se agrego la detalle compra";
                                $id =  $id_det_com;
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


                    } else {
                        $errors[] = "No se puede crear una compra sin productos";
                    }
                } catch (mysqli_sql_exception $e) {
                    $errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
                }
                $messages[] = "Se agrego la compra";
                $id = $id_insertado;
                $sql2 = recuperarDatos("SELECT * from tblcom WHERE PK_COMPRA='$id';");
                $tabla = "tblcom";
                $tipo = "creacion";
                $fecha = date("Y-m-d H:i:s");

                $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
                $query = mysqli_query($con, $sqllog);

                ($query) ? $messages[] = "Se creo el log de resgistro" : $errors[] = "algo salio mal al crear el resgistro";
            } else {

                $errors[] = "No se pudo agregar la compra";
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