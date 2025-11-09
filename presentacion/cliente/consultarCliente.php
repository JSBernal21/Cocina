<?php
if (strtolower($_SESSION["rol"]) != 'admin') {
    if ($_SESSION["id"] == NULL) {
        header("Location: ?pid=" . base64_encode("presentacion/inicio.php"));
    } else {
        header("Location: ?pid=" . base64_encode("presentacion/sesion" . $_SESSION["rol"] . ".php"));
    }
} else {
    include("presentacion/menuAdmin.php");
}
$cliente = new Cliente();
$clientes = $cliente->consultar();

?>


<div class="container">
	<div class="row mt-5">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h3>Consultar Cliente</h3>
				</div>
				<div class="card-body">
					<?php
					if (count($clientes) == 0) {
						echo "<div class='alert alert-warning' role='alert'>
                                    No hay registros
                                    </div>";
					} else {
						?>
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th scope="col">id</th>
									<th scope="col">Nombre</th>
									<th scope="col">Apellido</th>
									<th scope="col">Fecha de Nacimiento</th>
									<th scope="col">Correo</th>
									<th scope="col">Estado</th>
									<th scope="col">Accion</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($clientes as $c) {
									echo "<tr>";
									echo "<td>" . $c->getId() . "</td>";
									echo "<td>" . $c->getNombre() . "</td>";
									echo "<td>" . $c->getApellido() . "</td>";
									echo "<td>" . $c->getfechaNacimiento() . "</td>";
									echo "<td>" . $c->getCorreo() . "</td>";
									echo "<td><div id='estado" . $c->getId() . "'>" . (($c->getEstado() == 1) ? ("<div class ='bg-success rounded-5 text-light ps-2'><i class='fa-solid fa-check'></i> Habilitado</div></div></td>") : ("<div class ='bg-danger rounded-5 text-light ps-2'><i class='fa-solid fa-xmark'></i> Deshabilitado</div></div></td>"));
									echo "<td id='opcion" . $c->getId() . "' >" . (($c->getEstado() == 1) ? ("<div class='text-danger' ><i class='fa-solid fa-user-xmark'></i> Deshabilitar</div></td>") : ("<div  class='text-success'><i class='fa-solid fa-user-check'></i> Habilitar</div></td>"));
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
<?php
foreach ($clientes as $c) {

	?>
	<script>
		
		let estado<?php echo $c->getId() ?> = <?php echo $c->getEstado() ?>;
		$('#opcion<?php echo $c->getId() ?>').on("click", function () {
			console.log("Activo");
			$('#opcion<?php echo $c->getId() ?>').empty();
			if (estado<?php echo $c->getId() ?>) { 
				url = "?pid=<?php echo base64_encode("presentacion/cliente/estadoClienteAjax.php") ?>&c=" + <?php echo $c->getId() ?> + "&e=0";
				$('#estado<?php echo $c->getId() ?>').load(url, function() {
					estado<?php echo $c->getId() ?>=0;
				})
				$('#opcion<?php echo $c->getId() ?>').append("<div class='text-success' ><i class='fa-solid fa-user-check'></i> Habilitar </div>");
			} else {
				url = "?pid=<?php echo base64_encode("presentacion/cliente/estadoClienteAjax.php") ?>&c=" + <?php echo $c->getId() ?> + "&e=1";
				$('#estado<?php echo $c->getId() ?>').load(url, function() {
					estado<?php echo $c->getId() ?>=1;
				})
				$('#opcion<?php echo $c->getId() ?>').append("<div class='text-danger' ><i class='fa-solid fa-user-xmark'></i> Deshabilitar </div>");
			}
		});
	</script>
	<?php
}
?>