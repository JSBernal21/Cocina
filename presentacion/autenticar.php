<?php
require_once("logica/Persona.php");
require_once("logica/Admin.php");
require_once("logica/Cliente.php");
$error = false;
if (isset($_POST["autenticar"])) {
	$correo = $_POST["correo"];
	$clave = $_POST["clave"];
	$admin = new Admin("", "", "", $correo, $clave);
	if ($admin->autenticar()) {
		$_SESSION["id"] = $admin->getId();
		$_SESSION["rol"] = "Admin";
		header('Location: index.php?pid=presentacion/sesionAdmin.php');
	} else {
		$cliente = new Cliente("", "", "", $correo, $clave, "");
		if ($cliente->autenticar()) {
			$_SESSION["id"] = $cliente->getId();
			$_SESSION["rol"] = "Cliente";
			header('Location: index.php?pid=presentacion/sesionCliente.php');
		} else {
			$error = true;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Cocina Etilica</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light align-items-center my-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<div class="card shadow border-3 rounded-4">
					<div class="card-header text-center bg-warning text-dark rounded-top-4">
						<h3 class="mb-0"><i class="fa-solid fa-wine-bottle"><i
									class="fa-solid fa-wine-glass-empty"></i></i>Cocina Etílica</h3>
					</div>
					<div class="card-body p-4">
						<h4 class="text-center mb-4">Iniciar Sesión</h4>
						<form method="post" action="?pid=presentacion/autenticar.php"> 
							<div class="mb-3">
								<input type="email" class="form-control form-control-lg" name="correo"
									placeholder="Correo" required>
							</div>
							<div class="mb-3">
								<input type="password" class="form-control form-control-lg" name="clave"
									placeholder="Clave" required>
							</div>
							<div class="d-grid">
								<button type="submit" class="btn btn-warning btn-lg fw-bold" name="autenticar">
									<i class="fa-solid fa-right-to-bracket"></i> Ingresar
								</button>
							</div>
						</form>
						<?php

						if ($error) {
							echo "<div class='alert alert-danger text-center mt-3' role='alert'>
                                        <i class='fa-solid fa-circle-exclamation'></i>
                                        Correo o clave incorrecta
                                      </div>";
						}

						?>
						<div class="text-center my-4">
							<span>¿No tienes una cuenta? <a href="presentacion/registrar/registrarCliente.php"
									class="text-decoration-none">Regístrate aquí</a></span>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>