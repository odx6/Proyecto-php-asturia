<?php
require_once("config.php");
// Importa las clases necesarias de PHPMailer


   // include $ruta."/vendor/autoload.php";
// Crea una nueva instancia de PHPMailer
function  consultarNombre($id,$tabla,$columna,$columnaN){
    //@param $id es el id por el cual buscar
    //@param $tabla es el nombre de la tabla la cual buscar
    //@columnaN es el nombre de la columna que almacena a los ides
    //@param columna  es el nombre de la columna que tiene el nombre 

if(isset($id) && isset($tabla) && isset($columna) && isset($columnaN)){
     if(is_numeric($id)) $id = intval($id);
   
   global $con;
    
    $sql="SELECT $columnaN FROM $tabla WHERE $columna='$id';";
  
    if (isset($id) && $id != NULL) {
      $resultado = mysqli_query($con,$sql);
  
      if (isset($resultado) && $resultado != NULL) {
          $tem = mysqli_fetch_array($resultado);
          if (isset($tem) && $tem != NULL) {
            $nombre = $tem[$columnaN];

         echo  $nombre;
          }else{
            echo $id;
          }
      }
  }
  
  }else{
     echo $id;
  }


}





  

?>

