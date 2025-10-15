<?php
$id = $_SESSION["id"];
if (strtolower($_SESSION["rol"]) != 'admin') {
    if ($_SESSION["id"] == NULL) {
        header("Location: ?pid=".base64_encode("presentacion/inicio.php") );
    } else {
        header("Location: ?pid=" .base64_encode("presentacion/sesion". $_SESSION["rol"] .".php") );
    }
} else {

    
    include("presentacion/menuAdmin.php");
}
?>