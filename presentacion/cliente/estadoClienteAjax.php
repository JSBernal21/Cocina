<?php 
$cliente = new Cliente($_GET["c"],"","","","","",$_GET["e"]);
$cliente -> cambiarEstado($_GET["c"]);
if($_GET["e"]==1){
    echo "<div class ='bg-success rounded-5 text-light ps-2'><i class='fa-solid fa-check'></i> habilitado</div>";
}else{
    echo "<div class ='bg-danger rounded-5 text-light ps-2'><i class='fa-solid fa-xmark'></i> Deshabilitado</div>";
}
?>