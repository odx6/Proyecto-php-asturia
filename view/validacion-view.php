<?php

require_once ("./config/config.php");
    //Archivo comprueba si el usuario esta logueado	
include_once "./vendor/autoload.php";
$correo=$_GET['correo'];
$token=$_GET['token'];
$VALIDATE_AT = date("Y-m-d H:i:s");

//echo $correo."   ".$token;
//echo $sql = "select * from tblcatemp where STRCOR=".$correo.";";
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "El correo que ingresaste no es correcto";
}else{

    if (isset($_GET["correo"]) && isset($_GET["token"])) {
        $correo = $_GET["correo"];
        $token=$_GET["token"];
        
        $sql = "select * from tblcatemp where STRCOR='$correo' AND TOKEN='$token';";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1){
    
            $rw=mysqli_fetch_array($query);
            $IDEMP=$rw['IDEMP'];
            if(isset( $IDEMP)){
                $sql = "UPDATE tblcatemp SET TOKEN='', VERIFICATE_AT='".$VALIDATE_AT."' WHERE IDEMP='".$IDEMP."' ";
                $query = mysqli_query($con, $sql);
                if( $query){
                    //echo "correcto";
                    header("location: ./?view=exito");
               exit;
                }else{
                    header("location: ./?view=fail");
                }
            }
            
        
        }else{
    
            header("location: ./?view=fail");
        }
    } else {
        exit;
    }

}








?>