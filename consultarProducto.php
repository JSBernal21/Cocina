<?php
require_once ("logica/producto.php");
$producto = new Producto();
$productos = $producto->consultar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Cocina Etilica</title>
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
	rel="stylesheet">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col">
				<div class="card">
					<div class="card-header bg-success-subtle text-dark text-center">
						<h3>Productos registrados</h3>
					</div>
					<div class="card-body">
						<?php
                        if (count($productos) == 0) {
                            echo "<div class='alert alert-warning' role='alert'>
                                    No hay registros
                                    </div>";
                        } else {
                        ?>
						<table class="table table-striped table-hover text-start">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Nombre</th>
									<th scope="col">tamaño</th>
									<th scope="col">Precio de Venta</th>
									<th scope="col">Proveedor</th>
									<th scope="col">Tipo de Producto</th>
								</tr>
							</thead>
							<tbody>
							<?php
                            foreach ($productos as $p) {
                                echo "<tr>";
                                echo "<td>" . $p -> getIdProducto() . "</td>";
                                echo "<td>" . $p -> getNombre() . "</td>";
                                echo "<td>" . $p -> getTamaño() . "</td>";
                                echo "<td>" . $p -> getPrecioVenta() . "</td>";
                                echo "<td>" . $p -> getProveedor() . "</td>";
                                echo "<td>" . $p -> getTipoProducto() . "</td>";
                                echo "</tr>";
                            }
                            ?>
							</tbody>
						</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>