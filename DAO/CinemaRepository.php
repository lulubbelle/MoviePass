<?php

namespace DAO;

use Models\Cinema as Cinema;
use DAO\Connection as Connection;
use \Exception as Exception;
use Interfaces\ICinemaRepository as ICinemaRepository;
use DAO\CityRepository as CityRepository;

class CinemaRepository implements ICinemaRepository{

    private $connection;
    private $tableName = " CINEMA ";


    function GetAll()
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE ACTIVE = 1";
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);
            
            $ret = Cinema::mapData($queryResult);
            $CityRepo = new CityRepository();

            foreach($ret as $key){
                $city = $CityRepo->GetById($key->getCityId());

                $key->setCityDescription($city->getName());
            }
            return $ret;
        }catch(Exception $ex){
            throw $ex;
        }
    }
    
    function GetById($id)
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE ID = " . $id . ";";
            
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);

            $ret = Cinema::mapData($queryResult);

            return $ret[0];
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function AddOne($cinema){
        try
        {
            $query = 'INSERT INTO CINEMA (NAME, ADDRESS, CITY_ID) VALUES (:name, :address, :cityId);';
            
            $parameters['name'] = $cinema->getName();
            $parameters['address'] = $cinema->getAddress();
            $parameters['cityId'] = $cinema->getCityId();

            $this->connection = Connection::GetInstance();
            
            return $this->connection->ExecuteNonQuery($query, $parameters);
        }catch(Exception $ex){
            $errorMsg = $ex->getMessage();
            if(stripos($errorMsg, "CINEMA_UNIQUE_IX1") != false ){
                return "Ya existe un cine en la misma dirección";
            }else
                return "Ha ocurrido un error :( " . $errorMsg;
        }
    }

    public function DeleteCinema($id){
        $sql = "UPDATE CINEMA SET ACTIVE = 0 WHERE ID = :ID";
        $parameters['ID'] = $id;
        try
        {
            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($sql, $parameters);
            return "Eliminado Correctamente.";
        }
        catch(Exception $e)
        {
            return "Ha ocurrido un error :( " . $e->getMessage();
        }
    }

    public function Update($cinema){
        
        try
        {
            $sql = "UPDATE CINEMA SET NAME = :name, ADDRESS = :address , CITY_ID = :cityId, ACTIVE = :active WHERE ID = :Id";
            
            $parameters['Id'] = $cinema->getId();
            $parameters['name'] = $cinema->getName();
            $parameters['address'] = $cinema->getAddress();
            $parameters['cityId'] = $cinema->getCityId();
            $parameters['active'] = $cinema->getActive();
            
            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($sql, $parameters);

            return "Registro modificado correctamente";
        }
        catch(Exception $e)
        {
            return "Ha ocurrido un error :( " . $e->getMessage();
        }
    }

    public function GetByCity($cityId){
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE CITY_ID = " . $cityId . ";";
            
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);
          
            $ret = Cinema::mapData($queryResult);
            
            $CityRepo = new CityRepository();

            foreach($ret as $key){
                $city = $CityRepo->GetById($key->getCityId());

                $key->setCityDescription($city->getName());
            }
            return $ret;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function getAllRoomsByCinemaId($id){
        $this->data = array();
        if(file_exists($this->fileName)){

            $fileContent = file_get_contents($this->fileName);
            $arrayToDecode = ($fileContent) ? json_decode($fileContent, true) : array();

            foreach($arrayToDecode as $key => $value){
                if($value["ciudad"] == $ciudad || $ciudad == "Todos"){
                    $room = new Room();
                    $room->setId($value["id"]);
                    $room->setCapacidad($value["capacidad"]);
                    $room->setNombre($value["nombre"]);
                    $room->setValorEntrada($value["valorEntrada"]);
                    $room->setDireccion($value["direccion"]);
                    $room->setCiudad($value["ciudad"]);
    
                    array_push($this->data, $cine);
                }
            }
        }
        return $this->data;
    }

}


?>