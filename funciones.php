<?php

function get_Usuarios()
{
	global $conn;
	return pg_query($conn,"select usuario.nromiembro, usuario.nombre as name, usuario.apellido, 
						usuario.direccion, carrera.nombre as carrera 
						from usuario, carrera 
						where usuario.cod_carrera = carrera.codigo;");
}

function get_Usuarios_byID($users)
{
	global $conn;
	return pg_query($conn,"select nombre, apellido, nromiembro from usuario where nromiembro = $users;");
}

function get_Piezas()
{
	global $conn;
	return pg_query($conn,"select * from pieza;");
}

function get_Piezas_byKIT($kit)
{
	global $conn;
	return pg_query($conn,"select pieza.codigo, pieza.color from pieza, pieza_tipo_kit 
		where pieza_tipo_kit.cod_pieza = pieza.codigo 
		and pieza_tipo_kit.cod_kit = $kit;");
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
	return pg_query($conn,"delete from usuario where nromiembro = $id");
}

function add_Usuario($nromiembro, $nombre, $apellido, $direccion, $carrera)
{
	global $conn;
	return pg_query($conn, "insert into usuario 
							values($nromiembro,'$nombre','$nombre','$direccion', $carrera);");

}

function update_Invetario($que, $conque)
{
	global $conn;
	return pg_query("update inventario set nro_miembro=$conque where nro_miembro = $que");
}

function del_Usuario($id)
{
	global $conn;
	return pg_query($conn, "delete from usuario where nromiembro = $id");
}

function add_Pieza($codigo, $color,$descripcion)
{
	global $conn;
	return pg_query($conn, "insert into pieza 
							values($codigo,'$color', '$descripcion');");
}

function check_Usuario($id)
{
	global $conn;
	return pg_query("select * from usuario where nromiembro = $id");
}

function check_Pieza($id)
{
	global $conn;
	return pg_query("select * from pieza where codigo = $id");
}
function check_Kit($id)
{
	global $conn;
	return pg_query("select * from kit where codigo = $id");
}
function add_Kit($codigo, $nombre)
{
	global $conn;
	return pg_query($conn, "insert into kit 
							values($codigo,'$nombre');");
}

function get_Cajas()
{
	global $conn;
	return pg_query($conn, "select * from caja;");
}

function add_Pieza_tipo_kit($cantidad,$cod_kit,$cod_pieza)
{
	global $conn;
	return pg_query($conn, "insert into pieza_tipo_kit 
							values($cantidad,$cod_kit,$cod_pieza);");
}
function update_Pieza_tipo_kit($cantidad,$cod_kit,$cod_pieza)
{
	global $conn;
	return pg_query($conn, "update pieza_tipo_kit 
							set cantidad = $cantidad where cod_kit = $cod_kit and cod_pieza = $cod_pieza;");
}

function check_Pieza_tipo_kit($cod_pieza,$cod_kit)
{
	global $conn;
	return pg_query("select * from pieza_tipo_kit where cod_pieza=$cod_pieza and cod_kit=$cod_kit");
}

function get_kit_caja($id)
{
	global $conn;
	return pg_query("select cod_kit from caja where codigo = $id");
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


function get_persona_invt_fecha()//personas que inventariaron en la fecha
{
	global $conn;
	return pg_query($conn,"select usuario.nombre from usuario, inventario where usuario.nromiembro=inventario.nro_miembro and inventario.fecha=current_date;");
}


function get_piezas_perdidas()//piezas que se perdieron en las cajas
{
	global $conn;
	return pg_query($conn,"select caja.codigo as ccod,pieza.codigo as pcod from pieza, pieza_tipo_kit, detalle_pieza_caja,caja where pieza.codigo=pieza_tipo_kit.cod_pieza and pieza.codigo=detalle_pieza_caja.cod_pieza and pieza_tipo_kit.cantidad!=detalle_pieza_caja.cantidad and caja.codigo=detalle_pieza_caja.cod_caja;");
}
function get_cajas_incompletas()//cajas incompletas
{
	global $conn;
	return pg_query($conn,"select detalle_pieza_caja.cod_caja from detalle_pieza_caja, pieza_tipo_kit, caja where detalle_pieza_caja.cantidad!=pieza_tipo_kit.cantidad and detalle_pieza_caja.cod_pieza=pieza_tipo_kit.cod_pieza and caja.cod_kit=pieza_tipo_kit.cod_kit group by cod_caja;");
}

function get_cajas_por_kit()//cajas por kit
{
	global $conn;
	return pg_query($conn,"select kit.codigo, count(kit.codigo) as cant from kit,caja where caja.cod_kit=kit.codigo group by kit.codigo;");
}

function get_cantidad_invt_miembro()//cantidad de invetarios por cada miembro
{
	global $conn;
	return pg_query($conn,"select usuario.nromiembro ,count(inventario.codigo) from usuario, inventario where usuario.nromiembro=inventario.nro_miembro group by usuario.nromiembro;");
}


function get_cantidad_pieza_tipo()//cantidad de piezas por tipo a disposicion
{
	global $conn;
	return pg_query($conn,"select detalle_pieza_caja.cod_pieza, sum(detalle_pieza_caja.cantidad) from caja,detalle_pieza_caja where caja.codigo=detalle_pieza_caja.cod_caja group by cod_pieza;");
}

function get_piezas_mas_repetida_Ckit()//pieza mas repetidad de cada kit
{
	global $conn;
	return pg_query($conn,"select kit.codigo, pieza_tipo_kit.cod_pieza from pieza_tipo_kit, kit where pieza_tipo_kit.cod_kit=kit.codigo and pieza_tipo_kit.cantidad=(select max(cantidad) from pieza_tipo_kit) order by cod_kit;");
}


function get_cajas_completas_xkit()//cajas completas por kit
{
	global $conn;
	return pg_query($conn,"select caja.cod_kit, caja.codigo from caja where caja.codigo not in (select detalle_pieza_caja.cod_caja as cod from detalle_pieza_caja, pieza_tipo_kit, caja where detalle_pieza_caja.cantidad!=pieza_tipo_kit.cantidad and detalle_pieza_caja.cod_pieza=pieza_tipo_kit.cod_pieza and caja.cod_kit=pieza_tipo_kit.cod_kit group by cod_caja);");
}



?>