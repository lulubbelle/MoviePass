<?php

namespace DAO;

use Models\Room as Room;
use DAO\Connection as Connection;
use \Exception as Exception;

class RoomRepository {

    private $connection;
    private $tableName = " ROOM ";

    function GetAll()
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE ACTIVE = 1";
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);
            
            $ret = Room::mapData($queryResult);

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
            $query = "SELECT * FROM " . $this->tableName . " WHERE ID = :id ;";
            $parameters['id'] = $id;
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query, $parameters);

            $ret = Room::mapData($queryResult);

            return $ret[0];
        }catch(Exception $ex){
            throw $ex;
        }
    }
    

    public function Add(Room $room){
        try {
        $query= "INSERT INTO " . $this->tableName . " (id, cineId, name, capacity, price) VALUES(:id, :cineId, :name, :capacity, :price)";

        $parameters['id'] = $room->getId();
        $parameters['cineId'] = $room->getCinemaId();
        $parameters['name'] = $room->getName();
        $parameters['capacity'] = $room->getCapacity();
        $parameters['price'] = $room->getPrice();
        
        $this->connection = Connection::getInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);

        } catch(Exception $ex){
            return "Ha ocurrido un error " . $ex->getMessage();
            //TODO: VALIDAR QUE NO HAYA UNA room CON EL MISMO name
            /*$errorMsg = $ex->getMessage();
            if(stripos($errorMsg, "CINEMA_UNIQUE_IX1") != false ){
                return "Ya existe una room con ese name";
            }else
                return "Ha ocurrido un error :( " . $errorMsg;*/
        }
    }



    public function DeleteRoom($id){

        $sql = "UPDATE ROOM SET active=0 WHERE id = :id";
       
        $parameters['id'] = $id;
        try
        {
            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($sql, $parameters);
            return "Eliminado correctamente";
        }
        catch(Exception $e)
        {
            echo $e;
            
        }
    }


    public function UpdateRoom($room){

        try 
        {
        $query = "UPDATE ROOM SET name = :name, capacity = :capacity, PRICE = :price WHERE id = :id AND active = 1";
        $parameters['name'] = $room->getName();
        $parameters['capacity'] = $room->getCapacity();
        $parameters['id'] = $room->getId();
        $parameters['price'] = $room->getPrice();
    
          $this->connection = Connection::getInstance();
          $this->connection->ExecuteNonQuery($query, $parameters);

          return "Registro modificado correctamente";
        }

      catch(Exception $e)
      {
        return "Ha ocurrido un error :( " . $e->getMessage();
      }

    }

    public function getAllRoomsByCinemaId($id) {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE cineId = " . $id . " AND ACTIVE = 1;";
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);

            $ret = Room::mapData($queryResult);

            return $ret;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function ValidateDeleteCinema($cinemaId){
        $query = "SELECT * FROM " . $this->tableName . " WHERE cineId = :cinemaId AND ACTIVE = 1;";
        
        $parameters['cinemaId'] = $cinemaId;
        
        $this->connection = Connection::getInstance();
        $queryResult = $this->connection->Execute($query, $parameters);
        
        $ret = Room::mapData($queryResult);
            
        return $ret;
    }
}


?>