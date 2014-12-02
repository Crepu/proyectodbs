<?php
session_start();
require "conect.php";
require "funciones.php";
require "header.php";

		
		
?>

	<div id="magia">
		<p>Llenando Kit <?echo $_GET['cod']?> </p>
		<table style="width:100%">
	      <tr class="thead">
	    <td>C&oacute;digo</td>
	    <td> Va?</td>
	    <td>Cantidad</td>
	    <td>Color</td>
	  </tr>
	 	<form action="procesar_llenado.php" method="POST">
	<?php 
		$_SESSION['cod'] = $_GET['cod'];

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
	    			<td><input type='checkbox' name='checked[]' value=".$row[$i]['codigo']."></td>
	    			<td><input type='text' name=".$row[$i]['codigo']."></td>
	    			<td class='borde' style='background-color:".$row[$i]['color'].";'>  </td>
	    			
	  				
	  			</tr>";
		}

	 ?>
	</table> 
				<input type="submit" value="Llenar">
			</form> 
	</div>