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
<div id="caja">
	<div class="cajita">
		<p>LISTADO DE CAJAS</p>
		<?php
			$res = get_Cajas();
			$row = pg_fetch_all($res);
			for ($i=0; $i < sizeof($row); $i++) { 
				# code...
				echo "<div class='caha' style='background-color:".$row[$i]['color'].";'>
				<a href='inventario.php?cod=".$row[$i]['codigo']."'>".$row[$i]['codigo']."
				</a></div>";
			}

			if(!isset($_GET['cod']))
			{
				$_SESSION['codigo'] = "NULL";
				$_SESSION['estado'] = "NULL";
				$_SESSION['kit'] = "NULL";
				$_SESSION['inventario'] = "NULL";
			}
		?>

	</div>

	<div id="dat_caja">
		<p>CAJA</p>
		<div>

		</div>
		<div>
			<?php
				if(isset($_GET['cod']))
				{
					$_SESSION['codigo'] = "Caja codigo ".$_GET['cod'];
					$res = get_kit_caja($_GET['cod']);
					$row = pg_fetch_all($res);
					$_SESSION['kit'] = "Kit codigo ".$row[0]['cod_kit'];
					$kit = $row[0]['cod_kit'];
					$res = get_cajas_completas_xkit();
					$row = pg_fetch_all($res);
					$_SESSION['estado'] = "Incompleta";
					for ($i=0; $i <sizeof($row) ; $i++) { 
						# code...
						if (in_array($_GET['cod'],$row[$i])) {
							# code...
							$_SESSION['estado'] = "Completa";
						}
					}

				}
			?>
			<p class="text"><? echo $_SESSION['codigo']?></p><p class="text"><? echo $_SESSION['kit']?></p>
			<p class="text"><? echo $_SESSION['estado']?></p>
			<? if(isset($_GET['cod']))
				{
					//echo '<p class="text"><button type="button" onClick="location.href=\'inventariar.php?cod='.$_GET['cod'].'&kit='.$kit.'\'">Inventariar</button></p>';
				}
			?>
			<div id="listap">
				Piezas que faltan: <br>
				<?php
					if(isset($_GET['cod']))
					{
						$res = get_piezas_perdidas();
						$row = pg_fetch_all($res);
						for($i = 0; $i < sizeof($row); $i++)
						{
							if($row[$i]['ccod'] == $_GET['cod'])
							{
								echo "<li id='data'>Pieza codigo:".$row[$i]['pcod']."</li>";
							}
						}
					}
				?>

			</div>
		


		</div>
	</div>

</div>