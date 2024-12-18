<?php
	//session_start();
	//$_SESSION['user_id']=1;

    $update="UPDATE `sesion` SET `delete_at`='".date('Y-m-d H:i:s')."' WHERE pk_sesion='".session_id()."';";
	$sesiones=mysqli_query($con, $update);

	if (isset($_SESSION['user_id']) && $sesiones) {

		unset($_SESSION['dashboard']);
		unset($_SESSION['empleados']);
		unset($_SESSION['taller']);
		unset($_SESSION['seguro']);
		unset($_SESSION['empresa']);
		unset($_SESSION['sector']);
		unset($_SESSION['vehiculos']);
		unset($_SESSION['tarjeta']);
		unset($_SESSION['reparaciones']);
		unset($_SESSION['choque']);
		unset($_SESSION['configuracion']);
		unset($_SESSION['empleados'] );
		unset($_SESSION['configuracion'] );
		unset($_SESSION['productos'] );
		unset($_SESSION['subcategorias'] );
		unset($_SESSION['dashboard']);
		unset($_SESSION['solicitud'] );
		unset($_SESSION['categorias'] );
		unset($_SESSION['unidades'] );
		unset($_SESSION['Inventario']);
		unset( $_SESSION['Entradas'] );
		unset( $_SESSION['Control'] );
		unset( $_SESSION['vehiculos'] );
		unset( $_SESSION['proveedores'] );
		unset( $_SESSION['compras'] );
		unset( $_SESSION['HoraInicio'] );
		unset( $_SESSION['HoraSalida'] );
		unset( $_SESSION['DiasInactivos']  );
		unset( $_SESSION['is_admin']  );
	
		session_destroy();
		header("location: ./?view=index"); //estemos donde estemos nos redirije al index
	}

?>