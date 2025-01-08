<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
require '../../../vendor/autoload.php';
$gump = new GUMP('en');

$gump->validation_rules([
    'id'    => 'required|numeric',
    'IDEMP'    => 'required|numeric',
    'STRNMRSR'    => 'required|alpha_numeric',
    'STRPRUT'    => 'required|numeric',
    'DTHCAP'    => 'required',
    'KLMFIN'    => 'required|numeric|min_numeric,50',
	'KLMINI'    => 'required|min_numeric,1',

]);

$gump->set_fields_error_messages([
    'id'      => [
        'required' => 'El operador es requerido',
        'numeric' => 'La clave del operador debe ser numerica',
    ],
    'IDEMP'      => [
        'required' => 'El operador es requerido',
        'numeric' => 'La clave del operador debe ser numerica',
    ],
    'STRNMRSR'   => [
        'required' => 'El automovil es obligatorio',
        'alpha_numeric' => 'La clave del automovil debe ser alfa numerica'
    ],
    'STRPRUT'   => [
        'required' => 'La  ruta es requerida y obligatoria',
        'alpha_numeric' => 'La clave de la ruta debe ser numerica'
    ],
    'DTHCAP'   => [
        'required' => 'La  fecha es obligatoria',

    ],
    'KLMFIN'   => [
        'required' => 'Los kilometros finales son requeridos',
        'numeric' => 'Los kilometros deben ser numericos',
        'min_numeric,50' => 'Los kilometros deben superar los 50 km para ser validos',
    ],
    'KLMINI'   => [
		'required' => 'Los kilometros iniciales son requeridos',
		'min_numeric,50' => 'Los kilometros deben superar los 1 km para ser validos',
	]

]);
$gump->filter_rules([
    'id' => 'trim|sanitize_string',
    'IDEMP' => 'trim|sanitize_string',
    'STRNMRSR' => 'trim|sanitize_string',
    'STRPRUT' => 'trim|sanitize_string',
    'DTHCAP' => 'trim|sanitize_string',
    'KLMFIN' => 'trim|sanitize_string',
    'KLMINI' => 'trim|sanitize_string'

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
    require_once("../../../config/funciones.php"); //Contiene las variables de configuracion para conectar a la base de datos


    $id = mysqli_real_escape_string($con, (strip_tags($_POST["id"], ENT_QUOTES)));
    $IDEMP = mysqli_real_escape_string($con, (strip_tags($_POST["IDEMP"], ENT_QUOTES)));
    $STRNMRSR = mysqli_real_escape_string($con, (strip_tags($_POST["STRNMRSR"], ENT_QUOTES)));
    $STRPRUT = mysqli_real_escape_string($con, (strip_tags($_POST["STRPRUT"], ENT_QUOTES)));
    $DTHCAP = mysqli_real_escape_string($con, (strip_tags($_POST["DTHCAP"], ENT_QUOTES)));
    $KLMFIN = mysqli_real_escape_string($con, (strip_tags($_POST["KLMFIN"], ENT_QUOTES)));
    $KLMINIC = mysqli_real_escape_string($con, (strip_tags($_POST["KLMINI"], ENT_QUOTES)));
    $OLDKLMFIN = getDato($id, 'tblreco', 'STRPRE', 'KLMFIN');
    $OLDKLMINI = getDato($id, 'tblreco', 'STRPRE', 'KLMINI');
    $Fecha = date("Y-m-d");
    $ultimo_registro = "SELECT * 
    FROM tblreco  WHERE STRNMRSR='" . $STRNMRSR . "'
    ORDER BY STRPRE DESC 
    LIMIT 1  OFFSET 1;";
    
        try {
            $query_kilometraje = mysqli_query($con, $ultimo_registro);
        } catch (mysqli_sql_exception $e) {
            $errors[] = "Error al consultar los datos";
            $errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
        }
        $num = mysqli_num_rows($query_kilometraje);
        if ($num  > 0) {
            $row = mysqli_fetch_array($query_kilometraje);
            $min_klm = $row['KLMFIN'];
        }else{
            $min_klm=0;
        }



    if($KLMFIN >$KLMINIC || $KLMFIN> $OLDKLMINI){

    if ($OLDKLMFIN == $KLMFIN && $KLMINIC>$min_klm ) {

        $sql = "UPDATE
        `tblreco`
    SET
        
        `IDEMP` = '" . $IDEMP . "',
        `STRNMRSR` = '" . $STRNMRSR . "',
        `STRPRUT` = '" . $STRPRUT . "',
     
       
        `DTHCAP` = '" . $DTHCAP . "'
        
    WHERE
        STRPRE ='" . $id . "'";
    } else {
        if ($KLMINIC > 0 && $KLMFIN > 0 && $KLMFIN >= $OLDKLMINI && $KLMINIC>$min_klm) {
            $KLMRECO = $KLMFIN - $OLDKLMINI;
            $sql = "UPDATE
            `tblreco`
        SET
            
            `IDEMP` = '" . $IDEMP . "',
            `STRNMRSR` = '" . $STRNMRSR . "',
            `STRPRUT` = '" . $STRPRUT . "',
            `KLMFIN` = '" . $KLMFIN . "',
            `KLMRECO` = '" . $KLMRECO . "',
            `DTHCAP` = '" . $DTHCAP . "'
            
        WHERE
            STRPRE ='" . $id . "'";
        }else{

            $errors[]="Error al actualizar kilometraje";
        }
      
    }
  



  if(isset($sql)){
    $oldata=recuperarDatos("SELECT * from tblreco WHERE 	 STRPRE='$id';");
    $mensaje = insertarLog($sql, 'tblreco', 'Actualizacion', 'STRPRE', $id,$oldata);
    (str_contains($mensaje, 'Error') === false) ? $messages[] = $mensaje : $errors[] = $mensaje;
  }else{
  $errors[]="Verificar  que el kilometraje inicial sea menor al final o el kilometraje inicial sea mayor a ".$min_klm;
  }
    
}else{

    $errors[]="el kilometro final debe ser mayor al kilometro inicial";
}
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
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
<?php
}
?>