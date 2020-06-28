<?php
include ("panel.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Destinos</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/style.css"> 
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
			<?php
			error_reporting(E_ALL ^ E_NOTICE);
            include ("panel.php");
            ini_set("soap.wsdl_cache_enabled", "0");
			@$boleto = $_GET['IDBoleto'];
			$client = new SoapClient("http://18.234.73.61:3131/ws/autobus.wsdl");
            $parametros = array("IDBoleto" => $boleto);
			$response = $client->__soapCall('CancelarBoleto', array($parametros));
            
            if(count((array)$response ) != 0){
                    echo "<h1>".$response->{'IDBoleto'}."</h1>";
                    echo "<h1>".$response->{'IDViaje'}."</h1>";
                    echo "<h1>".$response->{'IDAsiento'}."</h1>";
                    echo "<h1>".$response->{'MensajeConfirmacion'}."</h1>";
			}else{
			}
            ?>
		</table>
		</header>
</body>
</html>