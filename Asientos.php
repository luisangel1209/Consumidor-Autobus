<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Destinos</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/popup.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
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
       <div id="popup" class="overlay">
            <div id="popupBody">
                <h2>Realizar Compra</h2>
                <a id="cerrar" href="#">&times;</a>
                <div class="popupContent">
    <form action="Compra.php" target="" method="post" name="form">

	<label for="idviaje">ID Viaje</label>
	<input type="text" name="idviaje" id="idviaje" value="<?php echo $_GET['viaje'];?>" />

	<label for="idbus">ID Autobus</label>
	<input type="text" name="idbus" value="<?php echo $_GET['bus'];?>" id="apellidos"/>
	
	<label for="idasiento" >ID Asiento</label>
	<input type ="text" name="idasiento" id="asunto"/>
	
	<label for="nombre">Nombre Pasajero</label>
	<input type ="text" name="nombre" id="nombre"/>
	
	<input type="submit" name="enviar" value="enviar datos"/>
</form>
                </div>
              </div>
    </div>
        <table>
			<thead>
				<tr>
					<th>ID Asiento</th>
					<th>Estatus</th>
                    <th>Elegir</th>
				</tr>
			</thead>
			<?php
			error_reporting(E_ALL ^ E_NOTICE);
            include ("panel.php");
            ini_set("soap.wsdl_cache_enabled", "0");
            @$Se = "Seleccionar";
			@$idbus = $_GET['bus'];
            @$b = "#popup";
            $client = new SoapClient("http://18.234.73.61:3131/ws/autobus.wsdl");
            $parametros = array("IDSeleccion" => $idbus);
            $response = $client->__soapCall('SeleccionAutobus', array($parametros));
            $var = array_values($response->{'Asiento'});
            foreach ($var as $key => $value) {  
            print "<tr>";
            print "<td>".$value->{'IdAsiento'}."</td>";
                if("".$value->{'Estatus'}."" == "Ocupado"){
                    print "<td>".$value->{'Estatus'}."</td>";
                    print "<td></td>";
                }else{
                    print "<td>".$value->{'Estatus'}."</td>";
                    print "<td><a href=".$b.">".$Se."</a></td>"; 
                }
            print "</tr>";
            }
            ?>
		</table>
		</header>
</body>
</html>