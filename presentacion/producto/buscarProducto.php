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
$producto = new Producto();
$productos = $producto -> consultar();
?>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3>Buscar Productos</h3>
                    </div>
                    <div class="card-body">
                    	<div class="row">
                    		<div class="col-4"></div>
                    		<div class="col-4">
                    			<input type="text" id="filtro" class="form-control" >
                    		</div>
                    	</div>
                    	<div id="resultados"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script>
$( "#filtro" ).on( "keyup", function() {
	if($("#filtro").val().length >= 3){
	    filtro = $("#filtro").val().replace(" ", "%20");
  		url = "?pid=<?php echo base64_encode("presentacion/producto/buscarProductoAjax.php") ?>&filtro=" + filtro;
  		$("#resultados").load(url);
  	}
} );

</script>
