<?php 
$cliente = new Cliente($_GET["c"],"","","","","",$_GET["e"]);
$cliente -> editarEstado();
if($_GET["e"]==1){
    echo "<i class='fa-solid fa-check'> </i> ";
}else{
    echo "<i class='fa-solid fa-xmark'></i>";
}
?>