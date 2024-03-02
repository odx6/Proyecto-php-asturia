<?php

function  SeEncuentra($dato, $arrays)
{
    //Esta funcion busca en un arreglo si se encuentra el valor proporcionado
    $flag = false;

    foreach ($arrays as $array) {


        if (in_array($dato, $array))  $flag = true;
    }
    return $flag;
}
// CODIGO 
include("../is_logged.php");
//DECODIFICA LOS DATOS ENVIADOS
$json_data = $_POST['inventario'];

// Decodificar los datos JSON
$datos = json_decode($json_data, true);



//Archivo comprueba si el usuario esta logueado
if (empty($_POST['IDEMP'])) {
    $errors[] = "El empleado esta vacio está vacío.";
} elseif (empty($_POST['INTIDTOP'])) {
    $errors[] = "Tipo de movimiento  está vacío.";
} elseif (empty($_POST['INTIDALM'])) {
    $errors[] = "El campo almacen esta vacio.";
} elseif (empty($_POST['INTFOL'])) {
    $errors[] = "El folio esta vacio.";
} elseif (empty($_POST['STROBS'])) {
    $errors[] = "Descripcion del movimiento  está vacío.";
} elseif (empty($_POST['inventario'])) {
    $errors[] = "Los productos está vacío.";
}elseif (empty($_POST['OLDMOV'])) {
    $errors[] = "Tipo de movimiento anterior requerido";
} elseif (empty($_POST['INTIDINV'])) {
    $errors[] = "Error al enviar datos.";
} elseif (count($datos) <= 0) {
    $errors[] = "Error no se puede ingresar una entrada o salida sin productos.";
} /* elseif (empty($_POST['kind'])) {
            $errors[] = "Kind está vacío.";
        }*/ elseif (
    !empty($_POST['IDEMP'])
    && !empty($_POST['INTIDTOP'])

    && !empty($_POST['INTIDALM'])
    && !empty($_POST['INTFOL'])
    && !empty($_POST['STROBS'])



    && !empty($_POST['INTIDINV'])
    && !empty($_POST['inventario'])
    && is_array($datos)
    && count($datos) > 0
    /*&& !empty($_POST['kind'])*/
) {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once("../../../config/RecuperarDatos.php"); //Contiene las variables de configuracion para conectar a la base de datos
    global $con;
    // escaping, additionally removing everything that could be (html/javascript-) code

    mysqli_autocommit($con, FALSE);
    $id = intval($_POST["INTIDINV"]);
    $MOVIMIENTO = intval($_POST["OLDMOV"]);
    $IDEMP = mysqli_real_escape_string($con, (strip_tags($_POST["IDEMP"], ENT_QUOTES)));
    $INTIDTOP = mysqli_real_escape_string($con, (strip_tags($_POST["INTIDTOP"], ENT_QUOTES)));
    if (!empty($_POST['INTTIPMOVU'])) $INTTIPMOV = mysqli_real_escape_string($con, (strip_tags($_POST["INTTIPMOVU"], ENT_QUOTES)));
    $INTIDALM = mysqli_real_escape_string($con, (strip_tags($_POST["INTIDALM"], ENT_QUOTES)));
    $INTFOL = mysqli_real_escape_string($con, (strip_tags($_POST["INTFOL"], ENT_QUOTES)));
    $STROBS = mysqli_real_escape_string($con, (strip_tags($_POST["STROBS"], ENT_QUOTES)));

    //$estado = mysqli_real_escape_string($con, (strip_tags($_POST["MONCTOPRO"], ENT_QUOTES)));
    $FECHA = date("Y-m-d");
    $created_at = date("Y-m-d H:i:s");

    //recupera los valores antes de la actualizacion
    //se debe filtrar por  inde inventario y movimiento

    $oldata = recuperarDatos("SELECT * from tblinv WHERE INTIDINV='$id';");

    if (!empty($_POST['INTTIPMOVU'])) {
        $sql = "UPDATE tblinv SET loked=1 ,Editor=0 ,INTIDTOP='" . $INTIDTOP . "',INTTIPMOV='" . $INTTIPMOV . "',INTFOL='" . $INTFOL . "', IDEMP='" . $IDEMP . "',INTALM='" . $INTIDALM . "',STROBS='" . $STROBS . "' WHERE INTIDINV='" . $id . "' ";
    } else {
        $sql = "UPDATE tblinv SET loked=1 ,Editor=0, INTIDTOP='" . $INTIDTOP  . "',INTFOL='" . $INTFOL . "', IDEMP='" . $IDEMP . "',INTALM='" . $INTIDALM . "',STROBS='" . $STROBS . "' WHERE INTIDINV='" . $id . "' ";
    }
    $sql2 = "SELECT * FROM `tblinvdet`  WHERE INTIDINV='$id' ORDER BY  INTIDINV   ASC;";
    $query_new1 = mysqli_query($con, $sql2);
    if (isset($query_new1) && $query_new1 != NULL &&  mysqli_num_rows($query_new1) > 0) {

        // Iterar sobre los resultados y crear una opción para cada uno

        while ($fila = mysqli_fetch_assoc($query_new1)) {

            //tiene que buscar uno por uno para no eliminarlo

            $primary=$fila['INTIDDET'];
            $inventario=$fila['INTIDINV'];
            $producto=$fila['SKU'];

            if (SeEncuentra($primary, $datos) == 1 ) {
            } else {
                $identificador = $primary;
                $deletevalue = recuperarDatos("SELECT * from tblinvdet WHERE INTIDDET='$identificador';");
                $sql3 = "DELETE FROM `tblinvdet` WHERE INTIDDET='$identificador';";
                $query_new2 = mysqli_query($con, $sql3);
                //eliminar tarjeta 
                 $deletetar=recuperarDatos("SELECT * from tbltarinv where INTIDINV=".$inventario." and SKU='".$producto."' and INTTIPMOV=".$MOVIMIENTO." ;");
               

                 $sqldeletetar="DELETE FROM tbltarinv where INTIDINV=".$inventario." and SKU='".$producto."' and INTTIPMOV=".$MOVIMIENTO." ;";
                 $querydelete=mysqli_query($con,$sqldeletetar);
                 if($querydelete){
                    $tabla = "tbltarinv";
                    $tipo = "Eliminacion";
                    $fecha = date("Y-m-d H:i:s");

                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $identificador . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $deletetar . "');";
                    $query = mysqli_query($con, $sqllog);
                    ($query) ? $messages[] = "Se creo el log de tarjeta detalle-compra compra " : $errors[] = "no se pudo generar el registro de detalle compra";


                 }



                //termina eliminar tarjeta 

                if ($query_new2) {

                    $tabla = "tblinvdet";
                    $tipo = "Eliminacion";
                    $fecha = date("Y-m-d H:i:s");

                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $identificador . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $deletevalue . "');";
                    $query = mysqli_query($con, $sqllog);
                }
            }
        }
    }




    $query_new = mysqli_query($con, $sql);
    if ($query_new) {
        $sql2 = recuperarDatos("SELECT * from tblinv WHERE INTIDINV='$id' ;");
        $tabla = "tblinv";
        $tipo = "Actualizacion";
        $fecha = date("Y-m-d H:i:s");

        $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $oldata . "','" . $sql2 . "');";
        $query = mysqli_query($con, $sqllog);

        $messages[] = "Se Actualizo correctamente el inventario";
    }
    $id;

    if ($query_new) {

        // La inserción fue exitosa
        $id_insertado = $id;


        if (is_array($datos)) {
            // Recorrer el array con foreach e imprimir sus valores
            $Pronuevos = array_filter($datos, function ($item) {
                return !array_key_exists('id', $item);
            });


            $UpdateProductos = array_filter($datos, function ($item) {
                return array_key_exists('id', $item);
            });

            //actualiza los  productos  ya ingresados
            foreach ($UpdateProductos as $producto) {
                $created_at = date("Y-m-d H:i:s");
                $created_at2 = date("Y-m-d");
                $oldproduct = recuperarDatos("SELECT * from tblinvdet  WHERE  INTIDDET='" . $producto['id'] . "';");
                $update = "UPDATE `tblinvdet` SET `STRREF`='" . $producto['referencia'] . "',`INTCAN`='" . $producto['cantidad'] . "',`MONCTOPRO`='" . $producto['total'] . "' WHERE INTIDDET='" . $producto['id'] . "';";

                $sqlupdate = mysqli_query($con, $update);

                if ($sqlupdate) {
                    $id = $producto['id'];
                    $sqlnew = recuperarDatos("SELECT * from tblinvdet  WHERE INTIDDET='" . $producto['id'] . "';");
                    $tabla = "tblinvdet";
                    $tipo = "Actualizacion";
                    $fecha = date("Y-m-d H:i:s");

                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $oldproduct . "','" . $sqlnew . "');";
                    $query = mysqli_query($con, $sqllog);
                    $messages[] = "Se Actualizo correctamente el detalle de inventario";
                }

                //se va actuañizar la tabla tbltarinventario con los datos
                $oldata = recuperarDatos("SELECT * from tbltarinv  WHERE INTIDINV='" . $producto['fk_inventario'] . "' AND SKU='" . $producto['sku'] . "' AND INTTIPMOV='$MOVIMIENTO';");
                $sqltar = "UPDATE `tbltarinv` SET `STRREF`='" . $producto['referencia'] . "',`INTCAN`='" . $producto['cantidad'] . "',`MONCTOPRO`='" . $producto['total'] . "'  WHERE  INTIDINV='" . $producto['fk_inventario'] . "' AND SKU='".$producto['sku']."' AND INTTIPMOV='".$MOVIMIENTO."';";
                $querytar = mysqli_query($con, $sqltar);
                if ($querytar) {
                    $id = $producto['id'];
                    $sqlnew = recuperarDatos("SELECT * from tbltarinv  WHERE INTIDINV='" . $producto['fk_inventario'] . "'  AND SKU='" . $producto['sku'] . "'AND INTTIPMOV='$MOVIMIENTO' ;");
                    $tabla = "tbltarinv";
                    $tipo = "Actualizacion";
                    $fecha = date("Y-m-d H:i:s");

                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $oldata . "','" . $sqlnew . "');";
                    $query = mysqli_query($con, $sqllog);
                    $messages[] = "Se Actualizo actualizo correctamente la tarjeta de inventario";
                }
            }



            foreach ($Pronuevos as $pro) {



                $created_at = date("Y-m-d H:i:s");
                $created_at2 = date("Y-m-d");
                $SQL = " INSERT INTO tblinvdet( 
                    INTIDINV,
                     SKU,
                      STRREF,
                       INTCAN, 
                       INTIDUNI, 
                       MONPRCOS,
                        MONCTOPRO,
                         DTEHOR)
                       VALUES('" . $id_insertado . "','" . $pro['sku'] . "','" . $pro['referencia'] . "','" . $pro['cantidad'] . "','" . $pro['unidad'] . "','" . $pro['precio'] . "','" . $pro['total'] . "','" . $created_at . "');";
                $query_new = mysqli_query($con, $SQL);

                if ($query_new) {
                    $ide = mysqli_insert_id($con);
                    $sql4 = recuperarDatos("SELECT * from tblinvdet WHERE INTIDDET='" . $ide . "';");
                    $tabla = "tblinvdet";
                    $tipo = "creacion";
                    $fecha = date("Y-m-d H:i:s");

                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql4 . "');";
                    $query = mysqli_query($con, $sqllog);
                    $messages[] = "Se Agregaron productos nuevos";
                }


                $sql2 = "INSERT INTO tbltarinv(INTIDINV, DTEFEC, SKU, STRREF, INTCAN, INTIDUNI, MONPRCOS, MONCTOPRO, INTTIPMOV, INTALM, DTEHOR) 
                    VALUES ('" . $id_insertado . "','" . $created_at2 . "','" . $pro['sku'] . "','" . $pro['referencia'] . "','" . $pro['cantidad'] . "','" . $pro['unidad'] . "','" . $pro['precio'] . "','" . $pro['total'] . "','" . $INTTIPMOV . "','" . $INTIDALM . "','" . $created_at . "');";
                $query_new2 = mysqli_query($con, $sql2);

                if ($query_new2) {
                    $ide = mysqli_insert_id($con);
                    $sql4 = recuperarDatos("SELECT * from tbltarinv WHERE INTIDTAR='" . $ide . "' AND INTTIPMOV='$MOVIMIENTO';");
                    $tabla = "tbltarinv";
                    $tipo = "creacion";
                    $fecha = date("Y-m-d H:i:s");

                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql4 . "');";
                    $query = mysqli_query($con, $sqllog);
                    $messages[] = "Se Agrego la tarjeta de los productos nuevos";
                }
            }
        } else {
            echo 'El JSON no es un array válido.';
        }
    } else {
        // La inserción falló
        echo mysqli_error($con); // Muestra el error específico
    }
    if (!$query_new) $errors[] = "no se agrego el producto";
    if (!mysqli_errno($con)) {
        mysqli_commit($con);
    } else { // Si hubo algún error, revertir los cambios
        mysqli_rollback($con);
    }
} else {
    $errors[] = "desconocido.";
}

if (isset($errors)) {

?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>
<?php
}
if (isset($messages)) {

?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!<?php echo $id ?> </strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
<?php
}
//END CODIGO 



?>