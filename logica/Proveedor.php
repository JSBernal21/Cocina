<?php
require_once 'persistencia/Conexion.php';
require_once 'persistencia/ProveedorDAO.php';
class Proveedor {
	private $id;
	private $nombre;

	public function __construct($id="", $nombre="") {
		$this->id = $id;
		$this->nombre = $nombre;
	}
    public function consultar(){
        $conexion = new Conexion();
        $conexion -> abrir();
        $proveedorDAO = new ProveedorDAO();
        $conexion -> ejecutar($proveedorDAO -> consultar());
        $proveedores= array();
        while(($tupla = $conexion -> registro()) != null){
            $proveedor = new Proveedor($tupla[0], $tupla[1]);
            array_push($proveedores, $proveedor);
        }
        $conexion -> cerrar();
        return $proveedores;
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