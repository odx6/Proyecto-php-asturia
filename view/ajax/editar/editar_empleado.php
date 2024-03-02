<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
include("../../../config/funciones.php");
include("../../../config/verificarCorreo.php");
if (empty(trim($_POST['STRNSS']))) {
    $errors[] = "NSS está vacío.";
} elseif (trim(empty($_POST['STRRFC']))) {
    $errors[] = "RFC está vacío.";
} elseif (empty(trim($_POST['STRCUR']))) {
    $errors[] = "CURP está vacío.";
}
elseif (empty(trim($_POST['STRNDL']))) {
    $errors[] = "Licencia está vacío.";
} elseif (empty(trim($_POST['STRNOM']))) {
    $errors[] = "Nombre está vacío.";
} elseif (empty(trim($_POST['STRAPE']))) {
    $errors[] = "Apellidos está vacío.";
} elseif (empty(trim($_POST['STRDOM']))) {
    $errors[] = "Domicilio está vacío.";
} elseif (empty($_POST['STRLOC'])) {
    $errors[] = "Localidad está vacío.";
} elseif (empty(trim($_POST['STRMUN']))) {
    $errors[] = "Municipio está vacío.";
} elseif (empty(trim($_POST['STREST']))) {
    $errors[] = "Estado está vacío.";
} elseif (empty(trim($_POST['STRCP']))) {
    $errors[] = "Codigo Postal esta vacio.";
} elseif (empty(trim($_POST['STRPAI']))) {
    $errors[] = "Pais está vacío.";
} elseif (empty(trim($_POST['STRTEL']))) {
    $errors[] = "Telefono está vacío.";
} elseif (empty(trim($_POST['STRCOR']))) {
    $errors[] = "Correo Electronico está vacío.";
} elseif (empty($_POST['BITSUS'])) {
    $errors[] = "Estado está vacío.";
}
/* elseif (empty($_POST['kind'])) {
        $errors[] = "Kind está vacío.";
    }*/ elseif (
    !empty($_POST['STRNSS'])
    && !empty($_POST['STRRFC'])
    && !empty($_POST['STRCUR'])
    && !empty($_POST['STRNDL'])
    && !empty($_POST['STRNOM'])
    && !empty($_POST['STRAPE'])
    && !empty($_POST['STRDOM'])
    && !empty($_POST['STRLOC'])
    && !empty($_POST['STRMUN'])
    && !empty($_POST['STREST'])
    && !empty($_POST['STRCP'])
    && !empty($_POST['STRPAI'])
    && !empty($_POST['STRTEL'])
    && !empty($_POST['STRCOR'])
    && !empty($_POST['BITSUS'])

    /*&& !empty($_POST['kind'])*/
) {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once("../../../config/RecuperarDatos.php");

    // escaping, additionally removing everything that could be (html/javascript-) code
    //$IDEMP = mysqli_real_escape_string($con,(strip_tags($_POST["IDEMP"],ENT_QUOTES)));
    $STRNSS = mysqli_real_escape_string($con, (strip_tags($_POST["STRNSS"], ENT_QUOTES)));
    $STRRFC = mysqli_real_escape_string($con, (strip_tags($_POST["STRRFC"], ENT_QUOTES)));
    $STRCUR = mysqli_real_escape_string($con, (strip_tags($_POST["STRCUR"], ENT_QUOTES)));
    $STRNDL = mysqli_real_escape_string($con, (strip_tags($_POST["STRNDL"], ENT_QUOTES)));
    $STRNOM = mysqli_real_escape_string($con, (strip_tags($_POST["STRNOM"], ENT_QUOTES)));
    $STRAPE = mysqli_real_escape_string($con, (strip_tags($_POST["STRAPE"], ENT_QUOTES)));
    $STRDOM = mysqli_real_escape_string($con, (strip_tags($_POST["STRDOM"], ENT_QUOTES)));
    $STRLOC = mysqli_real_escape_string($con, (strip_tags($_POST["STRLOC"], ENT_QUOTES)));
    $STRMUN = mysqli_real_escape_string($con, (strip_tags($_POST["STRMUN"], ENT_QUOTES)));
    $STREST = mysqli_real_escape_string($con, (strip_tags($_POST["STREST"], ENT_QUOTES)));
    $STRCP = mysqli_real_escape_string($con, (strip_tags($_POST["STRCP"], ENT_QUOTES)));
    $STRPAI = mysqli_real_escape_string($con, (strip_tags($_POST["STRPAI"], ENT_QUOTES)));
    $STRTEL = mysqli_real_escape_string($con, (strip_tags($_POST["STRTEL"], ENT_QUOTES)));
    $STRCOR = mysqli_real_escape_string($con, (strip_tags($_POST["STRCOR"], ENT_QUOTES)));
    $OLDSTRCOR = mysqli_real_escape_string($con, (strip_tags($_POST["OLDSTRCOR"], ENT_QUOTES)));

    if (!empty($_POST['STRPWS'])) $STRPWS = sha1(md5(mysqli_real_escape_string($con, (strip_tags($_POST["STRPWS"], ENT_QUOTES)))));
    $id = intval($_POST['id']);

    $BITSUS = mysqli_real_escape_string($con, (strip_tags($_POST["BITSUS"], ENT_QUOTES)));
    if (empty($_FILES["STRIMGEU"]['name'])) {
        $sqlimg = "SELECT STRIMG FROM `tblcatemp` WHERE IDEMP=$id;";
        $queyimg = mysqli_query($con, $sqlimg);
        $num = mysqli_num_rows($queyimg);
        if ($num == 1) {
            $row = mysqli_fetch_array($queyimg);
            $Imagen = $row['STRIMG'];
        }
    } else {
        $sqlimg = "SELECT STRIMG FROM `tblcatemp` WHERE IDEMP=$id;";
        $queyimg = mysqli_query($con, $sqlimg);
        $num = mysqli_num_rows($queyimg);
        if ($num == 1) {
            $row = mysqli_fetch_array($queyimg);
            $pathimg = $row['STRIMG'];
        }


        //UPDATE IMG 
        //Agregar imagen
        $target_dir = "../../resources/images/Empleados/";
        $image_name = time() . "_" . basename($_FILES["STRIMGEU"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $imageFileZise = $_FILES["STRIMGEU"]["size"];

        if (($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") and $imageFileZise > 0) {
            $errors[] = "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
        } else if ($imageFileZise > 1048576) { //1048576 byte=1MB
            $errors[] = "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
        } else {
            /* Fin Validacion*/
            if ($imageFileZise > 0) {
                move_uploaded_file($_FILES["STRIMGEU"]["tmp_name"], $target_file);
                $imagen = basename($_FILES["STRIMGEU"]["name"]);
                $Imagen = "view/resources/images/Empleados/$image_name";
            }
        }
    }


    //variable de los permisos 

    if (empty($_POST['permisos'])) {
        $BITSUS = 2;
    } else {

        $permisos = $_POST["permisos"];
    }


    if ($OLDSTRCOR != $STRCOR) {
        $token = md5(rand());
        $sql = "UPDATE tblcatemp SET TOKEN='$token', VERIFICATE_AT=NULL WHERE STRNSS='" . $STRNSS . "' ";
        $query1 = mysqli_query($con, $sql);
        verificacionDeCorreo($STRCOR, $token);
    }
    $oldata = recuperarDatos("SELECT * from tblcatemp WHERE IDEMP='$id';");
    // UPDATE data into database
    if (!empty($_POST['STRPWS'])) {
        $sql = "UPDATE tblcatemp SET STRNSS='" . $STRNSS . "', STRRFC='" . $STRRFC . "', STRIMG='" . $Imagen ."', STRNOM='" . $STRNOM .  "', STRCUR='" . $STRCUR . "', STRNDL='" . $STRNDL . "', STRAPE='" . $STRAPE . "', STRDOM='" . $STRDOM . "', STRLOC='" . $STRLOC . "', STRMUN='" . $STRMUN . "', STREST='" . $STREST . "', STRCP='" . $STRCP . "', STRPAI='" . $STRPAI . "', STRTEL='" . $STRTEL . "',STRCOR='" . $STRCOR . "',STRPWS='" . $STRPWS . "',BITSUS='" . $BITSUS . "' WHERE IDEMP='" . $id . "' ";
    } else {
        $sql = "UPDATE tblcatemp SET STRNSS='" . $STRNSS . "', STRRFC='" . $STRRFC . "', STRIMG='" . $Imagen ."', STRNOM='" . $STRNOM .  "', STRCUR='" . $STRCUR . "', STRNDL='" . $STRNDL . "', STRAPE='" . $STRAPE . "', STRDOM='" . $STRDOM . "', STRLOC='" . $STRLOC . "', STRMUN='" . $STRMUN . "', STREST='" . $STREST . "', STRCP='" . $STRCP . "', STRPAI='" . $STRPAI . "', STRTEL='" . $STRTEL . "',STRCOR='" . $STRCOR . "',BITSUS='" . $BITSUS . "' WHERE IDEMP='" . $id . "' ";
    }
    $query = mysqli_query($con, $sql);
    if ($query && !empty($pathimg) && $pathimg != "view/resources/images/Default/perfil.png") {
        if (file_exists("../../../" . $pathimg))
            unlink("../../../" . $pathimg);
    }
    if ($query) {

        $sql2 = recuperarDatos("SELECT * from tblcatemp WHERE IDEMP='$id';");
        $tabla = "tblcatemp";
        $tipo = "Actualizacion";
        $fecha = date("Y-m-d H:i:s");

        $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "','" . $oldata . "');";
        $query = mysqli_query($con, $sqllog);
    }

    //Verifico que el campo de la contraseña no este vacia by Amner Saucedo Sosa
    /*if(!empty(($password))){
    	$sql_password = "UPDATE empleado SET password='".$password."' WHERE id='".$id."' ";
    	$query_password = mysqli_query($con,$sql_password);
    }*/

    if ($query) {
        $sqlcopy = "SELECT * FROM empleado_permisos WHERE idempleado='$id'";
        $PermisosEliminados = mysqli_query($con, $sqlcopy);
        $sqldel = "DELETE FROM empleado_permisos WHERE idempleado='$id'";
        if (mysqli_query($con, $sqldel)) {
            while ($row = mysqli_fetch_array($PermisosEliminados)) {
                $idx=$row['idempleado_permiso'];
               //$sql2 = recuperarDatos("SELECT * from empleado_permisos WHERE idempleado_permiso='$idx';");
               $sql2 = "".$row['idempleado_permiso'].",".$row['idempleado'].",".$row['idpermiso'].",".$row['Habilidades']."";
                $tabla = "empleado_permisos";
                $tipo = "Eliminacion";
                $fecha = date("Y-m-d H:i:s");

                $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
                $query = mysqli_query($con, $sqllog);

            }
            $num_element = 0;
            $sw = true;
            if (!empty($_POST['permisos'])) {
                while ($num_element < count($permisos)) {
                    $sql_detalle = "INSERT INTO empleado_permisos(idempleado, idpermiso) VALUES('$id', '$permisos[$num_element]')";
                    mysqli_query($con, $sql_detalle) or $sw = false;
                    $ide = mysqli_insert_id($con);
                    $sql2 = recuperarDatos("SELECT * from empleado_permisos WHERE idempleado_permiso='$ide';");
                    $tabla = "empleado_permisos";
                    $tipo = "creacion";
                    $fecha = date("Y-m-d H:i:s");

                    $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $ide . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
                    $query = mysqli_query($con, $sqllog);
                    $num_element = $num_element + 1;
                }
            }
            $return = $sw;
        }

        $messages[] = "El empleado ha sido actualizado con éxito.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
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