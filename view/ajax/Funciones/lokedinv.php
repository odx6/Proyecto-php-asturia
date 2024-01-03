<?php

include("../is_logged.php");
require_once("../../../config/config.php");


$id = mysqli_real_escape_string($con, (strip_tags($_POST["id"], ENT_QUOTES)));

$user=$_SESSION['user_id'];


if (isset($id)) {
   
    $sql = "select * from tblinv where INTIDINV='$id'";
    $query_new = mysqli_query($con, $sql);
    if ($query_new) {
        $row = mysqli_fetch_array($query_new);

        $LOKED = $row['loked'];
        $EDITOR = $row['Editor'];


        if ($LOKED == 0 && $EDITOR==$user ) {
            $sql1 = "UPDATE `tblinv` SET `loked` = 1,`Editor` = 0   WHERE  INTIDINV = '$id';";
            $query_new1 = mysqli_query($con, $sql1);

            if($query_new1){

                echo "Correcto".$LOKED."Hola niño".$EDITOR;
            }else{echo 'error';}
            
        }else{
            echo "error";
        }

    } else {
        echo "error";
    }
}