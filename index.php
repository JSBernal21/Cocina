<?php
session_start();

require_once("logica/Persona.php");
require_once("logica/Admin.php");
require_once("logica/Cliente.php");
require_once("logica/Producto.php");
require_once("logica/Proveedor.php");
require_once("logica/TipoProducto.php");
if (isset($_GET["salir"])) {
    session_destroy();
    header("Location: ?pid=" . base64_encode("presentacion/inicio.php"));
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cocina Etilica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
</head>

<body>
    <?php


    $paginas_sin_autenticacion = array(
        "presentacion/inicio.php",
        "presentacion/autenticar.php",
        "presentacion/cliente/registrarCliente.php",
        "presentacion/producto/editarProducto.php",
    );
    $paginas_con_autenticacion = array(
        "presentacion/sesionAdmin.php",
        "presentacion/sesionCliente.php",
        "presentacion/producto/consultarProducto.php",
        "presentacion/cliente/consultarCliente.php",
        "presentacion/producto/crearProducto.php",
        "presentacion/cliente/estadoClienteAjax.php",
        "presentacion/producto/buscarProductoAjax.php",
        "presentacion/producto/buscarProducto.php",
    );
    if (!isset($_GET["pid"])) {
        include("presentacion/inicio.php");
    } else {
        $pid = base64_decode($_GET["pid"]);
        if (in_array($pid, $paginas_sin_autenticacion)) {
            include $pid;
        } else if (in_array($pid, $paginas_con_autenticacion)) {
            if (!isset($_SESSION["id"])) {
                include "presentacion/autenticar.php";
            } else {
                include $pid;
            }
        } else {
            echo "error 404";
        }
    }
    ?>
</body>

</html>