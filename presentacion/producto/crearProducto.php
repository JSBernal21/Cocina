<?php
require_once("logica/Producto.php");
require_once("logica/Proveedor.php");
require_once("logica/tipoProducto.php");
if (isset($_POST["registrar"])) {
	$nombre = $_POST["nombre"];
	$tamaño = $_POST["tamaño"];
	$precioVenta = $_POST["precioVenta"];
	$imagen = $_POST["imagen"];
	$proveedor = $_POST["proveedor"];
	$tipoProducto = $_POST["tipoProducto"];
	$producto = new Producto("", $nombre, $tamaño, $precioVenta, $imagen, $proveedor, $tipoProducto);
	$producto->registrar();
}
$proveedor = new Proveedor();
$proveedores = $proveedor->consultar();
$tipoProducto = new tipoProducto();
$tiposProductos = $tipoProducto->consultar();
include("presentacion/menuAdmin.php");
?>
<div class="container">
	<div class="row mt-5">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card">
				<div class="card-header">
					<h3>Registrar Producto</h3>
				</div>
				<div class="card-body">
					<?php
					if (isset($_POST["registrar"])) {
						echo "<div class='alert alert-success' role='alert'>
                                    Producto registrado
                                    </div>";
					}
					?>
					<form method="post" action="?pid=<?php echo base64_encode("presentacion/producto/crearProducto.php");?>">
						<div class="mb-3">
							<input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
						</div>
						<div class="mb-3">
							<input type="number" class="form-control" name="tamaño" placeholder="Tamaño" required>
						</div>
						<div class="mb-3">
							<input type="number" class="form-control" name="precioVenta" placeholder="Precio de Venta"
								required>
						</div>
						<div class="mb-3">
							<input type="text" class="form-control" name="imagen" placeholder="Imagen" required>
						</div>
						<select class="form-select mb-3" aria-label="Small select example" name="proveedor" required>
							<option selected>Elija un proveedor</option>
							<?php
							foreach ($proveedores as $p) {
								echo "<option value='" . $p->getId() . "'>" . $p->getNombre() . "</option>";
							}
							?>
						</select>
						<select class="form-select mb-3" aria-label="Small select example" name="tipoProducto" required>
							<option selected>Elija un tipo de producto</option>
							<?php
							foreach ($tiposProductos as $tp) {
								echo "<option value='" . $tp->getId() . "'>" . $tp->getNombre() . "</option>";
							}
							?>
						</select>
						<div class="mb-3">
							<button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>
</div>