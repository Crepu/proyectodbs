<?php
	session_start();
	require "header.php";
	require "conect.php";
	require "funciones.php";

	if(!$conn)
	{
		$_SESSION['mensaje'] = "Error al conectarse a la base de datos";
	}	
?>
<div id="magia">
		<div id = "agregar">
		 <form action="procesar_usuario.php?in=agrega" method="POST">
		<table>
			<tr>
				<td>Nombre:	<input type="text" name="nombre"></td>
				<td>Apellido: <input type="text" name="apellido"></td>
			</tr>
			<tr>
				<td>N. miembro: <input type="text" name="nromiembro"></td>
				<td>Direcci&oacute;n: <input type="text" name="direccion"></td>
			</tr>
		</table>
		Carrera:  <select name="carrera">
		<?php 
			$res = get_Carreras();

			if($res == NULL)
			{
				echo "fail";
			}		

			$row = pg_fetch_all($res);
			for($i = 0; $i<sizeof($row); $i++)
			{
				echo "<option value='".$row[$i]['codigo']."'>".$row[$i]['nombre']."</option>";

			}
		?>			
			</select> 
		<input type="submit" value="Agregar">
		</form> 
		<?php if(isset($_SESSION['mensaje'])) 
			echo "<p style='background-color: red;''>$_SESSION[mensaje]</p>";
			unset ($_SESSION['mensaje']);
		?>
	</div>
	 <form action="procesar_usuario.php?in=elimina" method="POST">
	 <table style="width:100%">
	  <tr class="thead">
	    <td>Nombre</td>
	    <td>N&uacute;mero miembro</td>
	    <td>Direcci&oacute;n</td>
	    <td>Carrera</td>
	    <td>Check</td>
	  </tr>
	<?php 
		
		if(isset($mensaje)) echo "<p id='error'>$mensaje</p>";

		$res = get_Usuarios();

		if($res == NULL)
		{
			echo "fail";
		}		

		$row = pg_fetch_all($res);
		for($i = 0; $i<sizeof($row); $i++)
		{
			echo "<tr>
	    			<td>".$row[$i]['name']." ".$row[$i]['apellido']."</td>
	    			<td>".$row[$i]['nromiembro']."</td>
	    			<td>".$row[$i]['direccion']."</td>
	    			<td>".$row[$i]['carrera']."</td>
	    			<td><input type='checkbox' name=".$row[$i]['nromiembro']." value=".$row[$i]['nromiembro']."></td>
	  			</tr>";
		}

	 ?>
	</table> 
		<p>(Selecciones los usuarios y luego aprete eliminar)<input type="submit" value="Eliminar"> </p>
	

</div>