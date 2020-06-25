<?php
session_start();
 
if(!isset($_SESSION['NumeroCliente'])){
    header('Location: Index.php');
    exit;
} else {
    // Show users the page!
}
?>