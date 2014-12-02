<?php
session_start();
require "conect.php";
require "funciones.php";


	if($_GET['in'] == "agrega")
	{
	
		if($_POST['codigo'] === "")
		{
			$_SESSION['mensaje'] = "El campo codigo kit es obligatorio.";
			header("Location: kit.php");
			die();
		}
	
		$res = check_Kit($_POST['codigo']);
		$row = pg_fetch_all($res);
		print_r($_POST);
		//die();
		if($row != NULL)
		{
			$_SESSION['mensaje'] = "El kit ya existe";
			header("Location: kit.php");
			die();
		}
		
		
		$res = add_Kit($_POST['codigo'],$_POST['nombre']);
		$_SESSION['mensaje'] = "Kit agregado exitosamente";
		header("Location: kit.php");
		die();
	
	}
?>