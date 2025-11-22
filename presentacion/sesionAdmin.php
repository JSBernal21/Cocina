<?php
$id = $_SESSION["id"];
if (strtolower($_SESSION["rol"]) != 'admin') {
    if ($_SESSION["id"] == NULL) {
        header("Location: ?pid=" . base64_encode("presentacion/inicio.php"));
    } else {
        header("Location: ?pid=" . base64_encode("presentacion/sesionCliente.php"));
    }
} else {
    $admin = new Admin($id);
    $admin->consultarPorId();
    include("presentacion/menuAdministrador.php");
}
?>