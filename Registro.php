<?php
	// Connection info. file
	include 'ConexionBD.php';
    $conexion = new mysqli($ServerName, $Username, $Password, $NameBD);
    if(!$conexion){
        die("Conexion fallida " . mysqli_connect_error());   
    }		
    // data sent from form login.html 
    @$name = $_POST['Nombre'];
    @$password = $_POST['Contra'];
    @$email = $_POST['Correo']; 
    $buscarUsuario = "SELECT * FROM Clientes WHERE Correo = '$_POST[Correo]' ";
    $result = $conexion->query($buscarUsuario);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        echo "<br />". "El Correo ya a sido registrado." . "<br />";
        echo "<a href='index.html'>Por favor escoga otro Correo</a>";
    }else{
        $query = "INSERT INTO Clientes (NumeroCliente,Nombre,Correo,Contra) VALUES (Null,'$name','$email' , '$password')";
        if ($conexion->query($query) === TRUE) {
            echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
            echo "<h4>" . "Bienvenido: " . $_POST['Nombre'] . "</h4>" . "\n\n";
            echo "<h5>" . "Hacer Login: " . "<a href='Index.html'>Login</a>" . "</h5>";
        }else{
            echo "Error al crear el usuario." . $query . "<br>" . $conexion->error;
        }
    }
    mysqli_close($conexion);  
?>