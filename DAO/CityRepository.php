<?php

namespace DAO;

use Models\City as City;
use DAO\Connection as Connection;
use \Exception as Exception;
use Interfaces\ICinemaRepository as ICinemaRepository;

class CityRepository{

    private $connection;
    private $tableName = " CITY ";

    function GetAll()
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . "WHERE ACTIVE = 1" . ";";
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);
            
            $ret = City::mapData($queryResult);

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

            $ret = City::mapData($queryResult);

            return $ret[0];
        }catch(Exception $ex){
            throw $ex;
        }
    }

}
?>