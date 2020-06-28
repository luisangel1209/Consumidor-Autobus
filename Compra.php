<?php
include ("panel.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Destinos</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
		
		.centrado{text-align:center;border:1px dotted #000; padding:8px; position:absolute; top:200px; left:600px;}
		
	</style>
</head>
<body>
<header>
		<div class="header">
			
		<h1>Sistema Autobuces ADOL</h1>
			<div class="optionsBar">
				<span>|</span>
				<span class="user"></span>
				<p>Bienvenido al sistema <?php echo $var; ?></p>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="CerrarSesion.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<nav>
			<ul>
				<li><a href="Index.php">Inicio</a></li>
				<li class="principal">
					<a href="#">Viajes</a>
					<ul>
						<li><a href="Destinos.php">Consulta Destinos</a></li>
						<li><a href="Viajes.php">Consultar Viajes</a></li>
					</ul>
				</li>
				<li><a href="Mis Viajes.php">Mis Viajes</a></li>
			</ul>
		</nav>
		<!-- <p class="centrado">texto centrado</p> -->
			<?php
			include ("panel.php");
            ini_set("soap.wsdl_cache_enabled", "0");
			@$idviaje = $_POST["idviaje"];
			@$idbus = $_POST["idbus"];
			@$iiasiento = $_POST["idasiento"];
			@$nombre = $_POST["nombre"];
            $client = new SoapClient("http://18.234.73.61:3131/ws/autobus.wsdl");
            $parametros = array("IDViaje" => $idviaje, "IDAutobus" => $idbus, "IDAsientoSeleccionado" => $iiasiento, "NombrePasajero" => $nombre, "Correo" => $var2);
			$response = $client->__soapCall('SeleccionAsiento', array($parametros));
			if(count((array)$response ) != 0){
				print "<h1>".$response->{'MensajeConfirmacion'}."</h1>";
				//foreach ($response as $key => $value) {
					//print "<p>".$value->{'IDBoleto'}."</p>";
				//}
			}
            ?>
    </table>
		</header>
</body>
</html>