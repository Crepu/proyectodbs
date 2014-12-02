<?php

function get_Usuarios()
{
	global $conn;
	return pg_query($conn,"select usuario.nromiembro, usuario.nombre as name, usuario.apellido, 
						usuario.direccion, carrera.nombre as carrera 
						from usuario, carrera 
						where usuario.cod_carrera = carrera.codigo;");
}

function get_Piezas()
{
	global $conn;
	return pg_query($conn,"select * from pieza;");
}

function get_Kits()
{
	global $conn;
	return pg_query($conn,"select * from kit;");
}

function get_Carreras()
{
	global $conn;
	return pg_query($conn,"select * from carrera;");
}

function check_Inventario_User($id)
{
	global $conn;
	return pg_query($conn,"select * from inventario where nro_miembro = $id");
}

function delete_User_byID($id)
{
	global $conn;
	return pg_query($conn,"delete from usuario where nro_miembro = $id");
}

function add_Usuario($nromiembro, $nombre, $apellido, $direccion, $carrera)
{
	global $conn;
	return pg_query($conn, "insert into usuario 
							values($nromiembro,'$nombre','$nombre','$direccion', $carrera);");

}

function check_Usuario($id)
{
	global $conn;
	return pg_query("select * from usuario where nromiembro = $id");
}







//---> consultas carlos

function get_personas_inventario_fecha($fecha_requerida)
{
	global $conn;
	return pg_query($conn,"select usuario.nombre 
							from usuario,inventario 
							where usuario.nromiembro = inventario.nro_miembro 
							and inventario.fecha = ".$fecha_requerida.";");
}






?>