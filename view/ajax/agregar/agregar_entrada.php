<?php
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
}   elseif (empty($_POST['inventario'])) {
    $errors[] = "inventario está vacío.";
} elseif (count($datos) <=0) {
    $errors[] = "Error no se puede ingresar una entrada o salida sin productos.";
}/* elseif (empty($_POST['kind'])) {
            $errors[] = "Kind está vacío.";
        }*/ elseif (
    !empty($_POST['IDEMP'])
    && !empty($_POST['INTIDTOP'])
    && !empty($_POST['INTTIPMOV'])
    && !empty($_POST['INTIDALM'])
    && !empty($_POST['INTFOL'])
    && !empty($_POST['STROBS'])
    && !empty($_POST['inventario'])
    && is_array($datos)
    && count($datos) >0

    /*&& !empty($_POST['kind'])*/
) {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
  global $con;
    // escaping, additionally removing everything that could be (html/javascript-) code
    $IDEMP = mysqli_real_escape_string($con, (strip_tags($_POST["IDEMP"], ENT_QUOTES)));
    $INTIDTOP = mysqli_real_escape_string($con, (strip_tags($_POST["INTIDTOP"], ENT_QUOTES)));
    $INTTIPMOV = mysqli_real_escape_string($con, (strip_tags($_POST["INTTIPMOV"], ENT_QUOTES)));
    $INTIDALM = mysqli_real_escape_string($con, (strip_tags($_POST["INTIDALM"], ENT_QUOTES)));
    $INTFOL = mysqli_real_escape_string($con, (strip_tags($_POST["INTFOL"], ENT_QUOTES)));
    $STROBS = mysqli_real_escape_string($con, (strip_tags($_POST["STROBS"], ENT_QUOTES)));
   
    $FECHA = date("Y-m-d");
    $created_at = date("Y-m-d H:i:s");




    //
    $sql = "INSERT INTO tblinv(
     DTEFEC,
     INTIDTOP,
     INTTIPMOV, 
     INTFOL, 
     IDEMP,
     STROBS,
     INTALM,
     DTEHOR)
    VALUES('" . $FECHA . "','" . $INTIDTOP . "','".$INTTIPMOV."','".$INTFOL."','".$IDEMP ."','".$STROBS."','".$INTIDALM."','" .$created_at ."');";

    


    
    $query_new = mysqli_query($con, $sql);
    $id;

    if ($query_new) {

        // La inserción fue exitosa
        $id_insertado = mysqli_insert_id($con);
        if (is_array($datos)  ) {
            // Recorrer el array con foreach e imprimir sus valores
            foreach ($datos as $elemento) {
                /*foreach ($elemento as $clave => $valor) {
                    echo $clave . ': ' . (is_array($valor) ? implode(', ', $valor) : $valor) . '<br>';
                }
                echo '<br>';*/

               
                $created_at=date("Y-m-d H:i:s");
                $created_at2=date("Y-m-d");
                $SQL=" INSERT INTO tblinvdet( 
                INTIDINV,
                 SKU,
                  STRREF,
                   INTCAN, 
                   INTIDUNI, 
                   MONPRCOS,
                    MONCTOPRO,
                     DTEHOR)
                   VALUES('" . $id_insertado . "','" . $elemento['SKU'][0] . "','".$elemento['STRREF']."','".$elemento['INTCANT']."','".$elemento['INTIDUNI'] ."','". $elemento['MONPRCOS']."','".$elemento['MONCTOPRO']."','" .$created_at ."');";
                    $query_new = mysqli_query($con, $SQL);


                $sql2="INSERT INTO tbltarinv(INTIDINV, DTEFEC, SKU, STRREF, INTCAN, INTIDUNI, MONPRCOS, MONCTOPRO, INTTIPMOV, INTALM, DTEHOR) 
                VALUES ('" . $id_insertado ."','" .$created_at2 . "','" . $elemento['SKU'][0] . "','".$elemento['STRREF']."','".$elemento['INTCANT']."','".$elemento['INTIDUNI'] ."','". $elemento['MONPRCOS']."','".$elemento['MONCTOPRO']."','".$INTTIPMOV."','".$INTIDALM."','" .$created_at ."');";
                 $query_new2 = mysqli_query($con, $sql2);
            }
        } else {
           
           echo  '<div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error! No se agrego ningun  producto al inventario  no se puede agregar un inventario vacio </strong>
            
        </div>';
        }

        
    } else {
        // La inserción falló
        echo mysqli_error($con); // Muestra el error específico
    }
    if (!$query_new) $errors[] = "no se agrego el producto";



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
        <strong>¡Bien hecho!<?php echo $id?> </strong>
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