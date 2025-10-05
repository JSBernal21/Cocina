<?php
$id = $_SESSION["id"];
if (strtolower($_SESSION["rol"]) != 'admin') {
    if ($_SESSION["id"] == NULL) {
        header("Location: index.php");
    } else {
        header("Location: ?pid=presentacion/sesion". $_SESSION["rol"] .".php");
    }
} else {

    $admin = new Admin($id);
    $admin->consultarPorId();


    ?>

    <body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="img/logo.jpg" alt="Logo" width="40" height="40" class="me-2">
                    Cocina Etilica
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav ms-auto text-end">
                        <li class="nav-item "><a class="nav-link active" href="#">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="?pid=presentacion/registrar/registrarProducto.php">Administrar productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Administrar categorias</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Pedidos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Reportes</a></li>

                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i
                                    class="fa-solid fa-user-circle me-2"></i>Administrador:
                                <?php echo $admin->getNombre() ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><a class="dropdown-item" href="#"><i
                                            class="fa-solid fa-user-pen me-2"></i> Editar Perfil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="index.php?salir=true"> <i
                                            class="fa-solid fa-right-from-bracket me-2"></i> Salir
                                    </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
    </body>
    <?php
}
?>