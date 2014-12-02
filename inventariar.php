<?php
session_start();
require "conect.php";
require "funciones.php";
require "header.php";

		
		
?>

	<div id="magia">
	 	<form action="procesar_inventariado.php" method="POST">
		<p>Inventariando Caja <?echo $_GET['cod']?> del kit <?echo $_GET['kit']?></p>
		Seleccione usuario: <select name='usuario'>";
		<?php
			$_SESSION['cod'] = $_GET['cod'];
			$res = get_Usuarios();
			$row = pg_fetch_all($res);
			for($i = 0; $i<sizeof($row); $i++)
			{ 
				
					echo "<option value='".$row[$i]['nromiembro']."'>".$row[$i]['name']." ".$row[$i]['apellido']."</option>";

			}
		?>
		</select> 
		<table style="width:100%">
	      <tr class="thead">
	    <td>C&oacute;digo</td>
	    <td>Cantidad</td>
	    <td>Color</td>
	  </tr>
	<?php 
		$_SESSION['cod'] = $_GET['cod'];

		if(isset($mensaje)) echo "<p id='error'>$mensaje</p>";

		$res = get_Piezas_byKIT($_GET['kit']);

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
	    			<td><input type='text' name=".$row[$i]['codigo']."></td>
	    			<td class='borde' style='background-color:".$row[$i]['color'].";'>  </td>
	    			
	  				
	  			</tr>";
		}

	 ?>
	</table> 
				<input type="submit" value="Inventariar">
			</form> 
	</div>