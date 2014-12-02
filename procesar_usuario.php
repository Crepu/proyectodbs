<?php
session_start();
require "conect.php";
require "funciones.php";

	if($_GET['in'] == "elimina" )
	{
		$_SESSION['inventariado'] = NULL;

		if(sizeof($_POST) == 0)
		{
			Header("Location: usuarios.php");
			die();
		}
		//print_r($_POST);
		foreach ($_POST as $key => $value) 
		{
			$res = check_Inventario_User($value);
			if(pg_fetch_all($res) != NULL) 
			{
				$_SESSION['inventariado'][$key] = $value;
			}

		}
		if(sizeof($_SESSION['inventariado']) > 0)
		{
			Header("Location: reemplazar_usuarios.php");
			die();
		}

		foreach ($_POST as $key => $value) 
		{
			$res = delete_User_byID($value);

		}

		$_SESSION['mensaje'] = "Usuarios eliminados exitosamente";
		Header("Location: usuarios.php");
		die();
	}

	if($_GET['in'] == "confirma")
	{

	}
	if($_GET['in'] == "agrega")
	{
		//print_r($_POST);
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