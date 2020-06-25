<?php
session_start();
if(!isset($_SESSION['Correo'])){
    header('Location: Index.html');
}else{
    //print_r($_SESSION['Nombre']);
    //print_r($_SESSION['Correo']);
    @$var = ($_SESSION['Nombre']);
    @$var2 = ($_SESSION['Correoo']);
    return $var;
    return $var2;
    //print_r($var);
}
?>