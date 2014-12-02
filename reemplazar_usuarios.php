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
		<p>El o los siguiente(s) usuarios no pueden ser eliminados porque tienen invetarios hechos.</p>
		 <form action="procesar_usuario.php?in=confirma" method="POST">
		<table style="width:100%">
			<tr class="thead">
				<td>Nombre</td>
				<td>Apellido</td>
				<td>C&oacute;digo</td>
			</tr>
		<?php
			foreach ($_SESSION['inventariado'] as $key => $value) {
				# code...
				$res = get_Usuarios_byID($value);
				$row = pg_fetch_row($res);
				$string = "<tr>";
				for ($i=0; $i < sizeof($row); $i++) { 
					# code...s
					$string = $string."<td>$row[$i]</td>";
				}
				$string = $string."</tr>";
				echo $string;
			}
		?>
		</table>
		</br>
		<p>¿C&oacute;mo desea proceder?</p>
		Asignar inventarios al siguiente usuario: <select name="usuario">
		<?php 
			$res = get_Usuarios();

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