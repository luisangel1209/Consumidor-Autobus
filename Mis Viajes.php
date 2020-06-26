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
						<li><a href="Viajes.php">Consulta Viajes</a></li>
					</ul>
				</li>
			</ul>
        </nav>
        <div id="popup" class="overlay">
            <div id="popupBody">
                <h2>Realizar Compra</h2>
                <a id="cerrar" href="#">&times;</a>
                <div class="popupContent">
    <form action="Compra.php" target="" method="post" name="form">

	<label for="idviaje">ID Boleto</label>
	<input type="text" name="idviaje" id="idviaje" value="<?php echo $_GET['IDBoleto'];?>" />

	<label for="idbus">ID Asiento Anterior</label>
	<input type="text" name="idbus" value="<?php echo $_GET['IDAsiento'];?>" id="apellidos"/>
	
	<label for="idasiento" >ID Asiento Nuevo</label>
	<input type ="text" name="idasiento" id="asunto"/>
	
	<input type="submit" name="enviar" value="enviar datos"/>
</form>
                </div>
              </div>
    </div>
        <table id="tabla">
			<thead>
				<tr>
					<th>ID Boleto</th>
					<th>ID Viaje</th>
					<th>ID Asiento</th>
					<th>Elige Modificar</th>
                    <th>Elige Cancelar</th>
				</tr>
            </thead>
            <?php
            include ("panel.php");
            error_reporting(E_ALL ^ E_NOTICE);
            ini_set("soap.wsdl_cache_enabled", "0");
            @$host= $_SERVER["HTTP_HOST"];
            @$url= $_SERVER["REQUEST_URI"];
            @$us= "http://" . $host . "/SistemaWeb/Modificar.php?IDBoleto=";
            @$uss= "http://" . $host . "/SistemaWeb/Eliminar.php?IDBoleto=";
            @$Se = "Modificar Boleto";
            @$See = "Cancelar Boleto";
            @$bo = "Boletos Disponibles";
            @$no = "No se encontraron viajes";
            @$b = "#popup";
            $client = new SoapClient("http://18.234.73.61:3131/ws/autobus.wsdl");
            $parametros = array("NombreIngresadoEnLaCompra" => $var, "CorreoIngresadoEnLaCompra" => $var2);
            $response = $client->__soapCall('MisViajes', array($parametros));
            $res = $response->{'MisViajes'};
            @$a = json_encode($res);
            //print_r($a);
            @$obj = json_decode($a, TRUE);
            //print_r($obj);
            //print_r(count($obj));
            if(count((array)$obj ) != 3){
            foreach ($obj as $key => $value) {
            print "<tr>";
            print "<td>".$value["IDBoleto"]."</td>";
            print "<td>".$value["IDViaje"]."</td>";
            print "<td>".$value["IDAsiento"]."</td>";
            print "<td><a href=".$us.$value["IDBoleto"]."&IDAsiento=".$value["IDAsiento"]."&IDViaje=".$value["IDViaje"].">".$Se."</a></td>";
            print "<td><a href=".$uss.$value["IDBoleto"].">".$See."</a></td>";
            print "</tr>";
            @$idbus = $value["IDViaje"];
            }
            }else{
                if(count((array)$obj ) == 3){
                    //print_r(count((array)$response ));
                    //print_r($a);
                    foreach ($response as $key => $value) {
                        print "<tr>";
                        print "<td>".$value->IDBoleto."</td>";
                        print "<td>".$value->IDViaje."</td>";
                        print "<td>".$value->IDAsiento."</td>";
                        print "<td><a href=".$us.$value->IDBoleto."&IDAsiento=".$value->IDAsiento."&IDViaje=".$value->IDViaje.">".$Se."</a></td>";
                        print "<td><a href=".$uss.$value->IDBoleto.">".$See."</a></td>";
                        print "</tr>";
                        @$idbus = $value->IDViaje;
                    }
                }else{
                print "<tr>";
                print "<td>".$no."</td>";
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
            alert( "Desea Modificar/Eliminar este Boleto " +celdas[0].innerHTML );
            return celdas[1].innerHTML;
            }
    </script>
</body>
</html>