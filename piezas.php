<?php
	session_start();
	require "header.php";
	require "conect.php";
	require "funciones.php";

	if(!$conn)
	{
		$_SESSION['mensaje']  = "Error al conectarse a la base de datos";
	}	
?>
<div id="magia">
	<div id = "agregar">
			 <form action="procesar_pieza.php?in=agrega" method="POST">
				
				<table>
					<tr>
						<td>Codigo:	<input type="text" name="codigo"></td>
						<td>Color: <input type="text" name="color"></td>
						<td>Descripcion: <input type="text" name="descripcion"></td>
					</tr>					
				</table>
				<input type="submit" value="Agregar">
			</form> 
			<?php if(isset($_SESSION['mensaje'])) 
				echo "<p style='background-color: red;''>$_SESSION[mensaje]</p>";
				unset ($_SESSION['mensaje']);
			?>
	</div>
</div>




<div id="magia">
	 <table style="width:100%">
	  <tr class="thead">
	    <td>C&oacute;digo</td>
	    <td>Color</td>
	    <td>Descripci&oacute;n</td>
	  </tr>
	<?php 

		if(isset($mensaje)) echo "<p id='error'>$mensaje</p>";

		$res = get_Piezas();

		if($res == NULL)
		{
			echo "fail";
		}		

		$row = pg_fetch_all($res);

		//print_r($row);
		for($i = 0; $i<sizeof($row); $i++)
		{
			echo "<tr>
	    			<td>".$row[$i]['codigo']."</td>
	    			<td class='borde' style='background-color:".$row[$i]['color'].";'>  </td>
	    			<td>".$row[$i]['descripcion']."</td>
	    			
	  			</tr>";
		}

	 ?>
	</table> 
	

</div>