<?php
class tipoProductoDao {
    private $idTipoProducto;
    private $nombre;

    public function __construct($idTipoProducto = "", $nombre = "") {
        $this->idTipoProducto = $idTipoProducto;
        $this->nombre = $nombre;
    }

    public function consultar(){
        return "select idTipoProducto, nombre
                from tipoProducto
                ";
    }
}
?>