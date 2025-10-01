<?php
class ProductoDAO
{
    private $idProducto;
    private $nombre;
    private $tamaño;
    private $precioVenta;
    private $imagen;
    private $proveedor;
    private $tipoProducto;

    public function __construct($idProducto = "", $nombre = "", $tamaño = "", $precioVenta = "", $imagen = "", $proveedor = "", $tipoProducto = "")
    {
        $this->idProducto = $idProducto;
        $this->nombre = $nombre;
        $this->tamaño = $tamaño;
        $this->precioVenta = $precioVenta;
        $this->imagen = $imagen;
        $this->proveedor = $proveedor;
        $this->tipoProducto = $tipoProducto;
    }

    public function registrar()
    {
        return "insert into producto (nombre, tamaño, precioVenta, imagen, Proveedor_idProveedor, TipoProducto_idTipoProducto)
                values ('" . $this->nombre . "', '" . $this->tamaño . "', '" . $this->precioVenta . "', '" . $this->imagen . "', '" . $this->proveedor . "', '" . $this->tipoProducto . "')";
    }
    public function consultar(){
        return "select p.idProducto, p.nombre, p.tamaño, p.precioVenta, tp.nombre, pr.nombre
                from producto p join tipoProducto tp on p.TipoProducto_idTipoProducto = tp.idTipoProducto
                join proveedor pr on p.Proveedor_idProveedor = pr.idProveedor
                order by p.idProducto asc
                ";
    }
}
?>