<?php

function  SeEncuentra($dato ,$arrays){
    //Esta funcion busca en un arreglo si se encuentra el valor proporcionado
      $flag=false;

    foreach($arrays as $array){


        if(in_array($dato,$array))  $flag=true;

        
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
} elseif (empty($_POST['INTTIPMOV'])) {
    $errors[] = "Entrada o salida no valida";
} elseif (empty($_POST['INTIDALM'])) {
    $errors[] = "El campo almacen esta vacio.";
} elseif (empty($_POST['INTFOL'])) {
    $errors[] = "El folio esta vacio.";
} elseif (empty($_POST['STROBS'])) {
    $errors[] = "Descripcion del movimiento  está vacío.";
} elseif (empty($_POST['STRREF'])) {
    $errors[] = "referencia está vacío.";
} elseif (empty($_POST['INTCAN'])) {
    $errors[] = "Cantidad está vacío.";
} elseif (empty($_POST['MONCTOPRO'])) {
    $errors[] = "Total está vacío.";
} elseif (empty($_POST['inventario'])) {
    $errors[] = "Los productos está vacío.";
}  elseif (empty($_POST['INTIDINV'])) {
    $errors[] = "Error al enviar datos.";
} /* elseif (empty($_POST['kind'])) {
            $errors[] = "Kind está vacío.";
        }*/ elseif (
    !empty($_POST['IDEMP'])
    && !empty($_POST['INTIDTOP'])
    && !empty($_POST['INTTIPMOV'])
    && !empty($_POST['INTIDALM'])
    && !empty($_POST['INTFOL'])
    && !empty($_POST['STROBS'])
    && !empty($_POST['STRREF'])
    && !empty($_POST['MONCTOPRO'])
    && !empty($_POST['INTCAN'])
    && !empty($_POST['INTIDINV'])
    && !empty($_POST['inventario'])

    /*&& !empty($_POST['kind'])*/
) {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
  global $con;
    // escaping, additionally removing everything that could be (html/javascript-) code

    $id = intval($_POST["INTIDINV"]);
    $IDEMP = mysqli_real_escape_string($con, (strip_tags($_POST["IDEMP"], ENT_QUOTES)));
    $INTIDTOP = mysqli_real_escape_string($con, (strip_tags($_POST["INTIDTOP"], ENT_QUOTES)));
    $INTTIPMOV = mysqli_real_escape_string($con, (strip_tags($_POST["INTTIPMOV"], ENT_QUOTES)));
    $INTIDALM = mysqli_real_escape_string($con, (strip_tags($_POST["INTIDALM"], ENT_QUOTES)));
    $INTFOL = mysqli_real_escape_string($con, (strip_tags($_POST["INTFOL"], ENT_QUOTES)));
    $STROBS = mysqli_real_escape_string($con, (strip_tags($_POST["STROBS"], ENT_QUOTES)));
    $STRREF = mysqli_real_escape_string($con, (strip_tags($_POST["STRREF"], ENT_QUOTES)));
    $MONCTOPRO = mysqli_real_escape_string($con, (strip_tags($_POST["MONCTOPRO"], ENT_QUOTES)));
    $INTCAN = mysqli_real_escape_string($con, (strip_tags($_POST["INTCAN"], ENT_QUOTES)));
    $estado = mysqli_real_escape_string($con, (strip_tags($_POST["MONCTOPRO"], ENT_QUOTES)));
    $FECHA = date("Y-m-d");
    $created_at = date("Y-m-d H:i:s");

    $sql = "UPDATE tblinv SET INTIDTOP='" . $INTIDTOP . "',INTTIPMOV='" . $INTTIPMOV ."',INTFOL='".$INTFOL."', IDEMP='" . $IDEMP . "',INTALM='" . $INTIDALM ."',STROBS='" . $STROBS ."' WHERE INTIDINV='" . $id . "' ";
    $sql2="SELECT * FROM `tblinvdet`  WHERE INTIDINV='$id' ORDER BY  INTIDINV   ASC;";
    $query_new1 = mysqli_query($con, $sql2);
    if (isset($query_new1) && $query_new1 != NULL &&  mysqli_num_rows($query_new1) > 0) {

        // Iterar sobre los resultados y crear una opción para cada uno

        while ($fila = mysqli_fetch_assoc($query_new1)) {

        //tiene que buscar uno por uno para no eliminarlo
        
        if(SeEncuentra($fila['INTIDDET'],$datos) ==1){
        

        }else{
            $identificador=$fila['INTIDDET'];
            $sql3="DELETE FROM `tblinvdet` WHERE INTIDDET='$identificador';";
            $query_new2 = mysqli_query($con, $sql3);
            
        }
        
        


        }
    }
    


    
    $query_new = mysqli_query($con, $sql);
    $id;

    if ($query_new) {

        // La inserción fue exitosa
        $id_insertado = $id;
      
        
        if (is_array($datos)) {
            // Recorrer el array con foreach e imprimir sus valores
            $Pronuevos = array_filter($datos, function($item) {
                return !array_key_exists('id', $item);
            });
            foreach ($Pronuevos as $pro) {
                
              

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
                       VALUES('" . $id_insertado . "','" . $pro['sku'][0] . "','".$pro['referencia']."','".$pro['cantidad']."','".$pro['unidad'] ."','". $pro['precio']."','".$pro['total']."','" .$created_at ."');";
                        $query_new = mysqli_query($con, $SQL);
    
    
                    $sql2="INSERT INTO tbltarinv(INTIDINV, DTEFEC, SKU, STRREF, INTCAN, INTIDUNI, MONPRCOS, MONCTOPRO, INTTIPMOV, INTALM, DTEHOR) 
                    VALUES ('" . $id_insertado ."','" .$created_at2 . "','" . $pro['sku'][0] . "','".$pro['referencia']."','".$pro['cantidad']."','".$pro['unidad'] ."','". $pro['precio']."','".$pro['total']."','".$INTTIPMOV."','".$INTIDALM."','" .$created_at ."');";
                     $query_new2 = mysqli_query($con, $sql2);
                }
               
            
        } else {
            echo 'El JSON no es un array válido.';
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