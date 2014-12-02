<?php

	require "header.php";
	require "conect.php";
	require "funciones.php";

	if(!$conn)
	{
		$mensaje = "Error al conectarse a la base de datos";
	}	
?>
<div id="magia">
	 <table style="width:100%">
	  <tr class="thead">
	    <td>C&oacute;digo</td>
	    <td>Color</td>
	    <td>Descripci&oacute;n</td>
	    <td>Check</td>
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
	    			<td><input type='checkbox' name='vehicle' value=".$row[$i]['codigo']."></td>
	  			</tr>";
		}

	 ?>
	</table> 
	

</div>