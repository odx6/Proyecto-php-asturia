<?php
	//session_start();
	//$_SESSION['user_id']=1;
	if (isset($_SESSION['user_id'])) {

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

		session_destroy();
		header("location: ./?view=index"); //estemos donde estemos nos redirije al index
	}

?>