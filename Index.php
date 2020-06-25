<?php
include ("panel.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Sistema Ventas</title>
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
				<li><a href="#">Inicio</a></li>
				<li class="principal">
					<a href="#">Viajes</a>
					<ul>
						<li><a href="Destinos.php">Consulta Destinos</a></li>
						<li><a href="Viajes.php">Consultar Viajes</a></li>
					</ul>
				<li><a href="Mis Viajes.php">Mis Viajes</a></li>
				</li>
			</ul>
		</nav>
	</header>
	<section id="container">
		<h1>Bienvenido al sistema <?php echo $var; ?></h1>
	</section>
</body>
</html>