<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Destinos</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
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
					</ul>
				</li>
                <li><a href="Mis Viajes.php">Mis Viajes</a></li>
			</ul>
		</nav>
		<center>
       <form method="POST" href="" width="100" height="200">
       Selecciona tu Salida 
       <select name="Salida">
            <option value="Veracruz">Veracruz</option> 
            <option value="Ciudad de Mexico">Ciudad de Mexico</option> 
            <option value="Monterrey">Monterrey</option>
            <option value="Chiapas">Chiapas</option>
            <option value="Baja California">Baja California</option>
        </select>
        Selecciona tu Destino
        <select name="Destino">
            <option value="Veracruz">Veracruz</option> 
            <option value="Ciudad de Mexico">Ciudad de Mexico</option> 
            <option value="Monterrey">Monterrey</option>
            <option value="Chiapas">Chiapas</option>
            <option value="Baja California">Baja California</option>
            <option value="Tijuana">Tijuana</option>
        </select>
            Ingresa la Fecha del Viaje (DD-MM-AA): <input type="text" name="Fecha">
        <input type="submit" value="Consultar Viaje">

        </form>
        </center>
        <table id="tabla">
			<thead>
				<tr>
					<th>ID Autobus</th>
					<th>Hora</th>
					<th>Precio</th>
					<th>Elige</th>
				</tr>
			</thead>
            <?php
            error_reporting(E_ALL ^ E_NOTICE);
            include ("panel.php");
            ini_set("soap.wsdl_cache_enabled", "0");
            @$host= $_SERVER["HTTP_HOST"];
            @$url= $_SERVER["REQUEST_URI"];
            @$us= "http://" . $host . "/SistemaWeb/Asientos.php?bus=";
            @$Se = "Seleccionar";
            @$no = "No se encontraron viajes";
            @$salida = $_POST["Salida"];
            @$destino = $_POST["Destino"];
            @$fecha = $_POST["Fecha"];
            if(isset($_POST["Salida"]) && isset($_POST["Destino"]) && isset($_POST["Fecha"])){
            $client = new SoapClient("http://18.234.73.61:3131/ws/autobus.wsdl");
            $parametros = array("Salida" => $salida, "Destino" => $destino, "Fecha" => $fecha);
            $response = $client->__soapCall('ConsultarViaje', array($parametros));
            $res = $response->{'Viaje'};
            @$a = json_encode($res);
            //print_r($a);
            @$obj = json_decode($a, TRUE);
            //print_r($obj);
            if(count((array)$obj ) != 5 && count((array)$obj ) != 0){
                foreach ($obj as $key => $value) {
                    print "<tr>";
                    print "<td>".$value["IDAutobus"]."</td>";
                    print "<td>".$value["Hora"]."</td>";
                    print "<td>".$value["Precio"]."</td>";
                    print "<td><a href=".$us.$value["IDAutobus"]."&viaje=".$value["IDViaje"].">".$Se."</a></td>";
                    print "</tr>";
                }
            }else{
                if(count((array)$obj ) == 5){
                    print_r(count((array)$response ));
                    print_r($a);
                    foreach ($response as $key => $value) {
                        print "<tr>";
                        print "<td>".$value->IDAutobus."</td>";
                        print "<td>".$value->Hora."</td>";
                        print "<td>".$value->Precio."</td>";
                        print "<td><a href=".$us.$value->IDAutobus."&viaje=".$value->IDViaje.">".$Se."</a></td>";
                        print "</tr>";
                    }
                }else{
                    if(count((array)$obj ) == 0){
                        print "<tr>";
                        print "<td>".$no."</td>"; 
                    }
                }
            }
            }
        ?>
		</table>
		</header>
           <script>
            document.getElementById("tabla").onclick=function(e){ 
            // obtenemos el elemento sobre el que se ha hecho click
            if(!e)e=window.event; 
            if(!e.target) e.target=e.srcElement; 
            // e.target ahora simboliza la celda en la que hemos hecho click
            // subimos de nivel hasta encontrar un tr
            var TR=e.target;
            while( TR.nodeType==1 && TR.tagName.toUpperCase()!="TR" )
            TR=TR.parentNode;
            var celdas=TR.getElementsByTagName("TD");
            // cogemos la primera celda TD del tr (si existe)
            if( celdas.length!=0 )
            // devolvemos su contenido
            alert( "Esta eligiendo el Viaje " +celdas[0].innerHTML );
            }
    </script>
</body>
</html>