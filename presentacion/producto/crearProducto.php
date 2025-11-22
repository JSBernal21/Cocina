<?php 
$id = $_SESSION["id"];
if ($_SESSION["rol"] != "admin") {
    header('Location: ?pid=' . base64_encode("noAutorizado.php"));
}
$admin = new Admin($id);
$admin->consultarPorId();

if (isset($_POST["crear"])) {

    $nombre = $_POST["nombre"];
    $tamano = $_POST["tamano"];
    $precio = $_POST["precio"];
    $proveedor = $_POST["proveedor"];
    $tipoProducto = $_POST["tipoProducto"];

    $imagenNombre = null; // POR DEFECTO NULL

    // Verificar si sí subieron una imagen y no está vacía
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === 0 && $_FILES["imagen"]["name"] != "") {

        // Crear nombre nuevo único
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $imagenNombre = time() . "." . $extension;

        // Ruta temporal real
        $imagenRutaLocal = $_FILES["imagen"]["tmp_name"];

        // Guardar archivo en carpeta
        copy($imagenRutaLocal, "imagenes/" . $imagenNombre);
    }

    // Crear producto con imagen o NULL
    $producto = new Producto(
        "",
        $nombre,
        $tamano,
        $precio,
        $imagenNombre,   // aquí va NULL si no subió nada
        $proveedor,
        $tipoProducto
    );

    $producto->crear();
}

?>
<body>
<?php include 'presentacion/menuAdministrador.php'; ?>
	<div class="container">
		<div class="row mt-5">
			<div class="col-4"></div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						<h3>Crear Producto</h3>
					</div>
					<div class="card-body">
						<?php 
						if(isset($_POST["crear"])){
						    echo "<div class='alert alert-success' role='alert'>
                                    Producto almacenado exitosamente!
                                    </div>";
						}
						?>
						<form method="post" enctype="multipart/form-data" action="?pid=<?php echo base64_encode("presentacion/producto/crearProducto.php")?>">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nombre"
                                        placeholder="Nombre" required>
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="tamano"
                                        placeholder="Tamaño" required>
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="precio"
                                        placeholder="Precio" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Imagen</label>
                                    <input class="form-control" type="file" id="formFile" name="imagen">
                                </div>
                                <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo Producto</label>
                                <select class="form-select" name="tipoProducto" required>
                                    <?php
                                    $tipo = new TipoProducto();
                                    $tipos = $tipo -> consultar();
                                    foreach($tipos as $t){
                                        echo "<option value='" . $t->getId() . "'>" . $t->getNombre() . "</option>";
                                    }
                                    ?>
                                </select>
                                </div>
                                <div class="mb-3">
                                <label for="proveedor" class="form-label">Proveedor</label>
                                <select class="form-select" name="proveedor" required>
                                    <?php
                                    $proveedor = new Proveedor();
                                    $proveedores = $proveedor -> consultar();
                                    foreach($proveedores as $p){
                                        echo "<option value='" . $p->getId() . "'>" . $p->getNombre() . "</option>";
                                    }
                                    ?>
                                </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" name="crear">Crear</button>
                                </div>
                            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>	