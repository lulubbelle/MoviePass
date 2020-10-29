<?php namespace DAO\DB;

use Models\Cine as Cine;
use DAO\BD\Connection as Connection;
use \PDOException as PDOException;

class cinemaPDO{
    private $Connection;
    public function __construct()
    {
        $this->Connection = null;
    }
    

    public function create($cine){
        $sql = "INSERT INTO cinema(name_cinema, address) VALUES(:name_cinema, :address)";

        $parameters['name_cinema']=$cine->getNombre();
        $parameters['address']=$cine->getDireccion();
        
        try {
            $this->Connection = Connection::getInstance();
            return $this->Connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e) {
			throw $e;
		}
    }

    //REMODELAR MODELOS (SALAS) Y LUEGO BD