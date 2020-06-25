<?php
session_start();
session_unset($_SESSION['Correo']);
session_destroy();

header('location: Index.html');
?>