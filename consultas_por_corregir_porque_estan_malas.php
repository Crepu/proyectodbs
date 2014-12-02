<?php

function get_persona_invt_fecha($current_date)//personas que inventariaron en la fecha
{
	global $conn;
	return pg_query($conn,"select usuario.nombre from usuario, inventario where usuario.nromiembro=inventario.nro_miembro and inventario.fecha=$current_date;");
}


function get_piezas_perdidas()//piezas que se perdieron en las cajas
{
	global $conn;
	return pg_query($conn,"select caja.codigo,pieza.codigo from pieza, pieza_tipo_kit, detalle_pieza_caja,caja where pieza.codigo=pieza_tipo_kit.cod_pieza and pieza.codigo=detalle_pieza_caja.cod_pieza and pieza_tipo_kit.cantidad!=detalle_pieza_caja.cantidad and caja.codigo=detalle_pieza_caja.cod_caja;");
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