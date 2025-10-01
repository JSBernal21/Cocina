<?php
require_once 'persistencia/Conexion.php';
require_once 'persistencia/tipoProductoDAO.php';
class tipoProducto {
	private $id;
	private $nombre;

	public function __construct($id="", $nombre="") {
		$this->id = $id;
		$this->nombre = $nombre;
	}
    public function consultar(){
        $conexion = new Conexion();
        $conexion -> abrir();
        $tipoProductoDAO = new tipoProductoDAO();
        $conexion -> ejecutar($tipoProductoDAO -> consultar());
        $tipoProductos= array();
        while(($tupla = $conexion -> registro()) != null){
            $tipoProducto = new tipoProducto($tupla[0], $tupla[1]);
            array_push($tipoProductos, $tipoProducto);
        }
        $conexion -> cerrar();
        return $tipoProductos;
    }

	public function getId() {
		return $this->id;
	}
    public function getNombre() {
        return $this->nombre;
    }

	public function setId($id) {
		$this->id = $id;
	}
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
}