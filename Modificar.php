<?php
@$nuevo = $_POST['IDAsientoNuevo'];
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
				<p>Veracruz, 30 Junio de 2020</p>
				<span>|</span>
				<span class="user"></span>
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
		<center>
		<form method="POST" href="Modificar.php" width="100" height="200">
       	<h3>Selecciona tu Asiento Nuevo <input type="text" name="IDAsientoNuevo"></h3>
        <input type="submit" value="Aceptar">

        </form>
        </center>
		<table>
			<thead>
				<tr>
					<th>ID Asiento Disponible</th>
				</tr>
			</thead>
			<?php
			error_reporting(E_ALL ^ E_NOTICE);
            include ("panel.php");
            ini_set("soap.wsdl_cache_enabled", "0");
            @$Se = "Seleccionar";
			@$idbus = $_GET['IDViaje'];
            @$b = "#popup";
            $client = new SoapClient("http://18.234.73.61:3131/ws/autobus.wsdl");
            $parametros = array("IDSeleccion" => $idbus);
            $response = $client->__soapCall('SeleccionAutobus', array($parametros));
            $var = array_values($response->{'Asiento'});
            foreach ($var as $key => $value) {  
            print "<tr>";
                if("".$value->{'Estatus'}."" == "Disponible"){
                    print "<td>".$value->{'IdAsiento'}."</td>";
                }else{
                }
            print "</tr>";
            }
            ?>
		</table>
			<?php
			error_reporting(E_ALL ^ E_NOTICE);
            include ("panel.php");
            ini_set("soap.wsdl_cache_enabled", "0");
			@$boleto = $_GET['IDBoleto'];
			@$idasiento = $_GET['IDAsiento'];
			@$idviaje = $_GET['IDViaje'];
			@$nuevo = $_POST['IDAsientoNuevo'];
			echo $nuevo;
			if(!empty($nuevo)){
				$client = new SoapClient("http://18.234.73.61:3131/ws/autobus.wsdl");
            	$parametros = array("IDBoleto" => $boleto, "IDViaje" => $idviaje, "IDAsientoAnterior" => $idasiento, "NuevoIDAsiento" => $nuevo);
				$response = $client->__soapCall('ModificarBoleto', array($parametros));
				if(count((array)$response ) != 0){
					foreach ($response as $key => $value) {
						echo "alert(".Boleto.")";
						header('Location: Mis%20Viajes.php');
					}
				}
			}else{
			}
            ?>
		</table>
		</header>
</body>
</html>