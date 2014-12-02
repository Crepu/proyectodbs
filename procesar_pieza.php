<?php
session_start();
require "conect.php";
require "funciones.php";


	if($_GET['in'] == "agrega")
	{
	
		if($_POST['codigo'] === "")
		{
			$_SESSION['mensaje'] = "El campo codigo pieza es obligatorio.";
			header("Location: piezas.php");
			die();
		}
	
		$res = check_Pieza($_POST['codigo']);
		$row = pg_fetch_all($res);

		
		if($row != NULL)
		{
			$_SESSION['mensaje'] = "La pieza ya existe";
			header("Location: piezas.php");
			die();
		}
		
		// agregar pieza
		$res = add_Pieza($_POST['codigo'],$_POST['color'],
							$_POST['descripcion']);

		$_SESSION['mensaje'] = "Pieza agregada exitosamente";
		header("Location: piezas.php");
		die();
	}
?>