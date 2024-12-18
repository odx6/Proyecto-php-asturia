<?php
include("../is_logged.php");
require_once("../../../config/config.php");
$valor = mysqli_real_escape_string($con, (strip_tags($_POST["valor"], ENT_QUOTES)));

$valor=str_pad($valor,6,'0',STR_PAD_LEFT);

//if (empty(trim($_POST["valor"]))) {
    if (!empty(trim($valor))) {
   
   // $sql = "SELECT COALESCE((SELECT SUM(INTCAN) FROM tbltarinv where SKU='$id' AND INTTIPMOV=1 ), 0) - COALESCE((SELECT SUM(INTCAN) FROM tbltarinv where SKU='$id' AND INTTIPMOV=2), 0) AS resultado;";
    $sql="SELECT * FROM folios WHERE valor='".$valor."'";
    $query_new = mysqli_query($con, $sql);
    $countFolio=mysqli_num_rows($query_new);

    $FolioProximo="SELECT MIN(valor + 1) AS siguiente_folio_disponible
    FROM (
        SELECT valor
        FROM folios
        UNION
        SELECT 0 AS valor 
        UNION
        SELECT MAX(valor) + 1  
        FROM folios
    ) AS folios_disponibles
    WHERE valor + 1 NOT IN (SELECT valor FROM folios)";
    $query_folio = mysqli_query($con, $FolioProximo);

    $dato= mysqli_fetch_array($query_folio);




    if($countFolio >0){

       echo  true;

    }else{

        echo  false;
      
    }
}
