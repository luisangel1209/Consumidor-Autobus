<?php
include ("panel.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Destinos</title>
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
						<li><a href="Viajes.php">Consulta Viajes</a></li>
					</ul>
				</li>
				<li><a href="Mis Viajes.php">Mis Viajes</a></li>
			</ul>
		</nav>
		
		<table>
			<thead>
				<tr>
                    <th>Origen</th>
					<th>Destino</th>
				</tr>
			</thead>
			<?php
			include ("panel.php");
            ini_set("soap.wsdl_cache_enabled", "0");
            /*@$data = json_decode(file_get_contents("localhost:3131/rest/viajes"), true);
            foreach ($data as $key => $value){
                print "<tr>";
                print "<td>".$value->{'origen'}."</td>";
                print "<td>".$value->{'destino'}."</td>";
                print "</tr>";
            }*/
            
            /*for($i=0; $i<count($data); $i++){
                print "<td>".$data[$i]["origen"]."</td>";
                print "<td>".$data[$i]["destino"]."</td>";
            }*/
            $client = new SoapClient("http://18.234.73.61:3131/ws/autobus.wsdl");
			$response = $client->__soapCall("ConsultarDestino", array());
			$res = $response->{'Viajes'};
            foreach ($response->{'Viajes'} as $h) {
				print "<tr>";
				print "<td>".$h->{'Salida'}."</td>";
				print "<td>".$h->{'Destino'}."</td>";
				print "</tr>";
            }
        ?>
		</table>
		</header>
</body>
</html>