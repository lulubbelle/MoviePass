<?php

namespace Models;

class Cine{

    private $id;
    private $capacidad;
    private $nombre;
    private $valorEntrada;
    private $direccion;
    private $ciudad;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCapacidad()
    {
        return $this->capacidad;
    }

    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getValorEntrada()
    {
        return $this->valorEntrada;
    }

    public function setValorEntrada($valorEntrada)
    {
        $this->valorEntrada = $valorEntrada;

        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getCiudad()
    {
        return $this->ciudad;
    }

    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }
}

?>