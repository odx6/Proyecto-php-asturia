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
  } else {
    $update_reco = "UPDATE
    `tblreco`
SET
    `DOUREN` = '0',
    `INPRT` = '0',
    `DOUCON` = '0'
WHERE
    STRPRE='" . $id . "';";

    try {
      $result = mysqli_query($con, $update_reco);
    } catch (mysqli_sql_exception $e) {

      $errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
    }
  }
}
function  recuperarDatos($consulta){
  global $con;
  $sqldelete=$consulta;
      $dataDelete=mysqli_query($con,$sqldelete);
      $data=mysqli_fetch_assoc($dataDelete);
      //$data=array_unique($data);
      $dataend=implode(',',$data);
  
      return $dataend;
  
    
  }

  function insertarLog($sql, $tabla, $tipo_operacion, $nom_clave_primaria, $id) {
    global $con;

    // Verificar parámetros necesarios
    if (empty($sql) || empty($tabla) || empty($tipo_operacion) || empty($nom_clave_primaria)) {
        return "Error: Parámetros inválidos o incompletos.";
    }

    try {
        // Ejecutar consulta principal
        $query_new = mysqli_query($con, $sql);
        if (!$query_new) {
            throw new Exception("Error al ejecutar la consulta principal:  ".$tabla . mysqli_error($con));
        }

        // Obtener ID del registro insertado
        (isset($id))? $id = mysqli_insert_id($con) :$id=$id ;
        

        // Recuperar datos del registro insertado
        $sql2 = "SELECT * FROM $tabla WHERE $nom_clave_primaria='$id'";
        $result = mysqli_query($con, $sql2);
        if (!$result) {
            throw new Exception("Error al recuperar datos: " . mysqli_error($con));
        }

        $fecha = date("Y-m-d H:i:s");

        // Preparar la consulta de log
        $sqllog = sprintf(
            "INSERT INTO `logs`(`fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) 
             VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
            mysqli_real_escape_string($con, $_SESSION['user_id']),
            mysqli_real_escape_string($con, $id),
            mysqli_real_escape_string($con, $tabla),
            mysqli_real_escape_string($con, $tipo_operacion),
            mysqli_real_escape_string($con, $fecha),
            mysqli_real_escape_string($con, $sql2)
        );

        // Ejecutar la consulta de log
        $query_log = mysqli_query($con, $sqllog);
        if (!$query_log) {
            throw new Exception("Error al insertar en logs: " . mysqli_error($con));
        }

        return "Operación completada con éxito.".$tabla;
    } catch (Exception $e) {
        // Manejo de errores
        return "Error: " . $e->getMessage();
    }
}

