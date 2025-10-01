<?php
class ProveedorDao {
    private $idProveedor;
    private $nombre;

    public function __construct($idProveedor = "", $nombre = "") {
        $this->idProveedor = $idProveedor;
        $this->nombre = $nombre;
    }

    public function consultar(){
        return "select idProveedor, nombre
                from proveedor
                ";
    }
}
?>