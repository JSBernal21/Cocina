<?php
$producto = new Producto();
$productos = $producto->consultar();
if ($_SESSION["rol"] == "admin") {
	include("presentacion/menuAdministrador.php");
} else if ($_SESSION["rol"] == "cliente") {
	include("presentacion/cliente/menuCliente.php");
}
?>
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
									<th scope="col">Id</th>
									<th scope="col">Nombre</th>
									<th scope="col">Tamaño</th>
									<th scope="col">Precio de venta</th>
									<th scope="col">imagen</th>
									<th scope="col">Proveedor</th>
									<th scope="col">Tipo de Producto</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($productos as $p) {
									echo "<tr>";
									echo "<td>" . $p->getId() . "</td>";
									echo "<td>" . $p->getNombre() . "</td>";
									echo "<td>" . $p->getTamano() . "</td>";
									echo "<td>" . $p->getPrecio() . "</td>";
									if ($p->getImagen() != "") {
										echo "<td><img src='imagenes/" . $p->getImagen() . "' height='60px'></td>";
									} else {
										echo "<td></td>";
									}
									echo "<td>" . $p->getProveedor()->getNombre() . "</td>";
									echo "<td>" . $p->getTipoProducto()->getNombre() . "</td>";
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