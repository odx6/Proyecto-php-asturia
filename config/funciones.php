<?php
require_once("config.php");
// Importa las clases necesarias de PHPMailer


// include $ruta."/vendor/autoload.php";
// Crea una nueva instancia de PHPMailer
function  consultarNombre($id, $tabla, $columna, $columnaN)
{
  //@param $id es el id por el cual buscar
  //@param $tabla es el nombre de la tabla la cual buscar
  //@columnaN es el nombre de la columna que almacena a los ides
  //@param columna  es el nombre de la columna que tiene el nombre 

  if (isset($id) && isset($tabla) && isset($columna) && isset($columnaN)) {
    if (is_numeric($id)) $id = intval($id);

    global $con;

    $sql = "SELECT $columnaN FROM $tabla WHERE $columna='$id';";

    if (isset($id) && $id != NULL) {
      $resultado = mysqli_query($con, $sql);

      if (isset($resultado) && $resultado != NULL) {
        $tem = mysqli_fetch_array($resultado);
        if (isset($tem) && $tem != NULL) {
          $nombre = $tem[$columnaN];

          echo  $nombre;
        } else {
          echo $id;
        }
      }
    }
  } else {
    echo $id;
  }
}
function  getDato($id, $tabla, $columna, $columnaN)
{
  //@param $id es el id por el cual buscar
  //@param $tabla es el nombre de la tabla la cual buscar
  //@columnaN es el nombre de la columna que almacena a los ides
  //@param columna  es el nombre de la columna que tiene el nombre 

  if (isset($id) && isset($tabla) && isset($columna) && isset($columnaN)) {
    if (is_numeric($id)) $id = intval($id);

    global $con;

    $sql = "SELECT $columnaN FROM $tabla WHERE $columna='$id';";

    if (isset($id) && $id != NULL) {
      $resultado = mysqli_query($con, $sql);

      if (isset($resultado) && $resultado != NULL) {
        $tem = mysqli_fetch_array($resultado);
        if (isset($tem) && $tem != NULL) {
          $nombre = $tem[$columnaN];

          return  $nombre;
        } else {
          return null;
        }
      }
    }
  } else {
    return null;
  }
}
function CalcularImporte($PrecioXLts, $LTS)
{
  if ($PrecioXLts > 0 && $LTS > 0) {
    return $PrecioXLts * $LTS;
  } else {
    return 0;
  }
}
function CalcularRendimiento($klmrecorridos, $totalkm)
{
  if ($klmrecorridos > 0 && $totalkm > 0) {
    return $klmrecorridos / $totalkm;
  } else {
    return 0;
  }
}
function CalcularDiferencia($klautorizados, $totalkm)
{
  if ($klautorizados > 0 && $totalkm > 0) {
    return $klautorizados - $totalkm;
  } else {
    return 0;
  }
}

function ActualizarTickets($id, $ruta)
{
  global $con;
  $importe = 0;
  $totalts = 0;

  $tickets = " SELECT * FROM `tblcattik` WHERE STRPRE='" . $id . "';";
  $query_tickets = mysqli_query($con, $tickets);
  if (mysqli_num_rows($query_tickets) > 0) {

    while ($row = mysqli_fetch_array($query_tickets)) {

      $STRPTIK = $row["STRPTIK"];
      $INTNO = $row["INTNO"];
      $STRPRUT = $row["STRPRUT"];
      $STRNMRSR = $row["STRNMRSR"];
      $STRPRE = $row["STRPRE"];
      $PCRXLIT = $row["PCRXLIT"];
      $LTS = $row["LTS"];
      $LOC = $row["LOC"];
      $DTEHOR = $row["DTEHOR"];


      //datos

      $importe += CalcularImporte($PCRXLIT, $LTS);
      $totalts += $LTS;
    }
    $autorizado = getDato($ruta, 'tblcatrut', 'STRPRUT', 'DOUKM');
    $klmrecorrido = getDato($id, 'tblreco', 'STRPRE', 'KLMRECO');

    $rendimiento = CalcularRendimiento($klmrecorrido, $totalts);
    $diferencia = CalcularDiferencia($autorizado, $klmrecorrido);
    $update_reco = "UPDATE
    `tblreco`
SET
    `DOUREN` = '" . $rendimiento . "',
    `INPRT` = '" . $importe . "',
    `DOUCON` = '" . $totalts . "',
    `DOUDIF` = '" . $diferencia . "'
WHERE
    STRPRE='" . $id . "';";

    try {
      $result = mysqli_query($con, $update_reco);
    } catch (mysqli_sql_exception $e) {

      $errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
    }
  }
}
?>

