<?php
require_once("logica/Producto.php");
require_once("logica/Proveedor.php");
require_once("logica/tipoProducto.php");



if (isset($_GET["id"])) {
	$producto = new Producto($_GET["id"]);
	$producto->consultarPorId();

}
$error = false;
if (isset($_POST["registrar"])) {
	$nombre = $_POST["nombre"];
	$tamaño = $_POST["tamaño"];
	$precioVenta = $_POST["precioVenta"];
	$imagen = $_POST["imagenAnt"];
	$proveedor = $_POST["proveedor"];
	$tipoProducto = $_POST["tipoProducto"];
	if ($_FILES["imagen"]["name"] != "") {
		$imgExtension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
		$tipos = array("jpeg", "jpg", "png");
		if (in_array($imgExtension, $tipos)) {
			if ($imagen != "") {
				unlink("imagenes/" . $imagen);
			}
			$imagen = date("Ymd_His") . "." . $imgExtension;
			$imagenRutaLocal = $_FILES["imagen"]["tmp_name"];
			copy($imagenRutaLocal, "imagenes/" . $imagen);
		} else {
			$error = true;
		}
	}

	$producto = new Producto($_POST["id"], $nombre, $tamaño, $precioVenta, $imagen, $proveedor, $tipoProducto);
	$producto->editar();
	$producto->consultarPorId();

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
					<h3>Editar Producto</h3>
				</div>
				<div class="card-body">
					<?php
					if (isset($_POST["registrar"])) {
						if ($error == false) {
							echo "<div class='alert alert-success' role='alert'>
                                    Producto modificado exitosamente
                                    </div>";
						} else {
							echo "<div class='alert alert-warning' role='alert'>
                                    informacion del producto modificado exitosamente, ERROR: error al cargar la imagen, tipo de imagen incopatible al sistema
                                    </div>";
						}

					}
					?>
					<form method="post" enctype="multipart/form-data"
						action="?pid=<?php echo base64_encode("presentacion/producto/editarProducto.php"); ?>">
						<input type="hidden" name="id" value="<?php echo $producto->getIdProducto(); ?>">
						<input type='hidden' class='form-control mb-3' name='imagenAnt'
							value='<?php echo $producto->getImagen() ?>' required>
						<div class="mb-3">
							<label>Nombre:</label>
							<input type="text" class="form-control" name="nombre" placeholder="Nombre" required
								value="<?php echo $producto->getNombre(); ?>">
						</div>
						<div class="mb-3">
							<label>Tamaño:</label>
							<input type="number" class="form-control" name="tamaño" placeholder="Tamaño" required
								value="<?php echo $producto->getTamano(); ?>">
						</div>
						<div class="mb-3">
							<label>Precio:</label>
							<input type="number" class="form-control" name="precioVenta" placeholder="Precio de Venta"
								required value="<?php echo $producto->getPrecioVenta(); ?>">
						</div>
						<div class="mb-3">
							<label>Imagen: </label>
							<?php if ($producto->getImagen() != "") { ?>
								<img src="imagenes/<?php echo $producto->getImagen() ?>" height='30px' class="mb-3">
							<?php } else { ?>
								<span class="mb-3">
									no hay Imagen guardada
								</span>
							<?php } ?>
							<br>
							<label class='form-label '>Cambiar su Imagen</label>
							<input type='file' class='form-control mb-3' name='imagen'>
						</div>
						<label>Elija un tipo de producto</label>
						<select class="form-select mb-3" aria-label="Small select example" name="proveedor" required>
							<?php
							foreach ($proveedores as $p) {
								echo "<option value='" . $p->getId() . "' " . (($p->getId() == $producto->getProveedor()) ? 'selected' : '') . ">" . $p->getNombre() . "</option>";
							}
							?>
						</select>
						<label>Elija un tipo de producto</label>
						<select class="form-select mb-3" aria-label="Small select example" name="tipoProducto" required>

							<?php
							foreach ($tiposProductos as $tp) {
								echo "<option value='" . $tp->getId() . "' " . (($tp->getId() == $producto->getTipoProducto()) ? 'selected' : '') . ">" . $tp->getNombre() . "</option>";
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