<?php
session_start();
require "conect.php";
require "funciones.php";

	//print_r($_POST);
	//echo $_POST[$_POST['checked'][0]];
	//echo $_SESSION['cod'];
	
	for($i = 0; $i<$_POST['checked']; $i++)
	{
		$res = check_Pieza_tipo_kit($_POST['checked'][$i],$_SESSION['cod']);
		if(pg_fetch_all($res) != NULL)
		{
			update_Pieza_tipo_kit($_POST[$_POST['checked'][$i]],$_SESSION['cod'],$_POST['checked'][$i]);

			header("Location: kit.php");
			die();
		}
			add_Pieza_tipo_kit($_POST[$_POST['checked'][$i]],$_SESSION['cod'],$_POST['checked'][$i]);
			die();
			header("Location: kit.php");
	}


		
	
?>