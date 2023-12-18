<?php
include("../is_logged.php");
require_once("../../../config/config.php");
$id = mysqli_real_escape_string($con, (strip_tags($_POST["id"], ENT_QUOTES)));
$cantidad = mysqli_real_escape_string($con, (strip_tags($_POST["cantidad"], ENT_QUOTES)));

if (isset($id) && isset($cantidad)) {
   
    $sql = "SELECT COALESCE((SELECT SUM(INTCAN) FROM tbltarinv where SKU='$id' AND INTTIPMOV=1), 0) - COALESCE((SELECT SUM(INTCAN) FROM tbltarinv where SKU='$id' AND INTTIPMOV=2), 0) AS resultado;";
    $query_new = mysqli_query($con, $sql);
    if ($query_new) {
        $row = mysqli_fetch_array($query_new);

        $stock = $row['resultado'];


        if ($stock > 0 && $stock >= $cantidad) {

            echo "stock";
        }else{
            echo $stock;
        }

    } else {
        echo "error";
    }
}
