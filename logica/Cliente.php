<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/ClienteDAO.php");

class Cliente extends Persona
{
    private $fechaNacimiento;

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $fechaNacimiento = "")
    {
        parent::__construct($id, $nombre, $apellido, $correo, $clave);
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function registrar()
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $clienteDAO = new ClienteDAO("", $this->nombre, $this->apellido, $this->fechaNacimiento, $this->correo, $this->clave);
        $conexion->ejecutar($clienteDAO->registrar());
        $conexion->cerrar();
    }

    public function consultar()
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $clienteDAO = new ClienteDAO();
        $conexion->ejecutar($clienteDAO->consultar());
        $clientes = array();
        while (($tupla = $conexion->registro()) != null) {
            $this->nombre = $tupla[1];
            $this->apellido = $tupla[2];
            $cliente = new Cliente($tupla[0], $tupla[1], $tupla[2], $tupla[4], "", $tupla[3]);
            array_push($clientes, $cliente);
        }
        $conexion->cerrar();
        return $clientes;
    }
    public function autenticar()
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $clienteDAO = new ClienteDAO("", "", "", "", $this->correo, $this->clave);
        $conexion->ejecutar($clienteDAO->autenticar());
        $tupla = $conexion->registro();
        $conexion->cerrar();
        if ($tupla != null) {
            $this->id = $tupla[0];
            return true;
        } else {
            return false;
        }
    }
    public function consultarPorId()
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $clienteDAO = new ClienteDAO($this->id);
        $conexion->ejecutar($clienteDAO->consultarPorId());
        $tupla = $conexion->registro();
        $this->nombre = $tupla[0];
        $this->apellido = $tupla[1];
        $this->fechaNacimiento = $tupla[2];
        $this->correo = $tupla[3];
        $conexion->cerrar();
    }
    


}



?>