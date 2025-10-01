<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/productoDAO.php");

class Producto
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
        $conexion = new Conexion();
        $conexion->abrir();
        $productoDAO = new ProductoDAO($this->idProducto, $this->nombre, $this->tamaño, $this->precioVenta, $this->imagen, $this->proveedor, $this->tipoProducto);
        $conexion->ejecutar($productoDAO->registrar());
        $conexion->cerrar();
    }
    public function consultar(){
        $conexion = new Conexion();
        $conexion -> abrir();
        $productoDAO = new ProductoDAO();
        $conexion -> ejecutar($productoDAO -> consultar());
        $productos = array();
        while(($tupla = $conexion -> registro()) != null){
            $producto = new Producto($tupla[0], $tupla[1], $tupla[2], $tupla[3], "", $tupla[4], $tupla[5]);
            array_push($productos, $producto);
        }
        $conexion -> cerrar();
        return $productos;
    }
    public function getIdProducto()
    {
        return $this->idProducto;
    }
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getTamaño()
    {
        return $this->tamaño;
    }
    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;
    }
    public function getPrecioVenta()
    {
        return $this->precioVenta;
    }
    public function setPrecioVenta($precioVenta)
    {
        $this->precioVenta = $precioVenta;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
    public function getProveedor()
    {
        return $this->proveedor;
    }
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
    }
    public function getTipoProducto()
    {
        return $this->tipoProducto;
    }
    public function setTipoProducto($tipoProducto)
    {
        $this->tipoProducto = $tipoProducto;
    }
}
?>