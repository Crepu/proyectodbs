<?php
session_start();
require "conect.php";
require "funciones.php";

	if($_GET['in'] == "elimina" )
	{
		
		
		foreach ($_POST as $key => $value) 
		{
			$res = delete_User_byID($value);
		}
	}

	if($_GET['in'] == "agrega")
	{
		print_r($_POST);
		if($_POST['nromiembro'] === "")
		{
			$_SESSION['mensaje'] = "El campo n&uacute;mero miembro es obligatorio.";
			header("Location: usuarios.php");
			die();
		}
		$res = check_Usuario($_POST['nromiembro']);
		$row = pg_fetch_all($res);

		if($row != NULL)
		{
			$_SESSION['mensaje'] = "El usuario ya existe";
			header("Location: usuarios.php");
			die();
		}

		$res = add_Usuario($_POST['nromiembro'],$_POST['nombre'],
							$_POST['apellido'],$_POST['direccion'],$_POST['carrera']);

		$_SESSION['mensaje'] = "Usuario agregado exitosamente";
		header("Location: usuarios.php");
		die();


	}

	

?>