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
		Asignar inventarios al siguiente usuario: <select name='usuario'>";
		<?php

			$res = get_Usuarios();

			if($res == NULL)
			{
				echo "fail";
			}		

			$row = pg_fetch_all($res);
			$cont = 0;
			for($i = 0; $i<sizeof($row); $i++)
			{ 
				//print_r($_SESSION['inventariado']);
				//echo $row[$i]['nromiembro']." ".in_array($row[$i]['nromiembro'], $_SESSION['inventariado']);
				if(!in_array($row[$i]['nromiembro'], $_SESSION['inventariado']))
				{
					echo "<option value='".$row[$i]['nromiembro']."'>".$row[$i]['name']." ".$row[$i]['apellido']."</option>";
					$cont++;
				}

			}
			if($cont == 0)
			{
				$_SESSION['mensaje'] = "No puede eliminar a todos los usuarios";
				header('Location: usuarios.php');
				die();
			}
		?>			
			</select> 
		<input type="submit" value="Asignar">
	</div> 
	 

</div>