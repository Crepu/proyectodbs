<?php

	require "header.php";
	require "conect.php";
	require "funciones.php";
	require "consultas_por_corregir_porque_estan_malas.php";

	if(!$conn)
	{
		$mensaje = "Error al conectarse a la base de datos";
	}	
?>

<?php
$fecha="2014-12-02";
$res=get_persona_invt_fecha($fecha);
$row=pg_fetch_all($res);
print_r($row);

?>