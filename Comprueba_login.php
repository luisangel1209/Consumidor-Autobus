<?php
			// Connection info. file
			include 'ConexionBD.php';

            $conexion = new mysqli($ServerName, $Username, $Password, $NameBD);
            if(!$conexion){
             die("Conexion fallida " . mysqli_connect_error());   
            }
			
			// data sent from form login.html 
			$email = $_POST['email']; 
			$password = $_POST['password'];
			
			// Query sent to database
			$result = mysqli_query($conexion, "SELECT Correo, Contra, Nombre FROM Clientes WHERE Correo = '$email'");


			
			// Variable $row hold the result of the query
			$row = mysqli_fetch_assoc($result);
			
			// Variable $hash hold the password hash on database
			$hash = $row['Contra'];
			$hash2 = $row['Nombre'];

            session_start();
			$_SESSION['Correo']=$row;
			
			$_SESSION['Nombre']=$row['Nombre'];
			$_SESSION['Correoo']=$row['Correo'];

			/* 
			password_Verify() function verify if the password entered by the user
			match the password hash on the database. If everything is OK the session
			is created for one minute. Change 1 on $_SESSION[start] to 5 for a 5 minutes session.
			*/
			if ($_POST['password'] == $hash) {	
				
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $row['Nombre'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ;						
				header('Location: Index.php');
				/*echo "<div class='alert alert-success mt-4' role='alert'><strong>Welcome!</strong> $row[Nombre]			
				<p><a href='edit-profile.php'>Edit Profile</a></p>	
				<p><a href='logout.php'>Logout</a></p></div>";*/
			
			} else {
                echo "".$hash."";
				echo "<div class='alert alert-danger mt-4' role='alert'>Email or Password are incorrects!
				<p><a href='http://localhost/SistemaWeb/Index.html'><strong>Please try again!</strong></a></p></div>";			
			}	
			?>