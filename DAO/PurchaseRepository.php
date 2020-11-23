<?php
namespace DAO;

use Models\Purchase as Purchase;
use DAO\Connection as Connection;
use \Exception as Exception;
use Interfaces\IPurchaseRepository as IPurchaseRepository;


class PurchaseRepository implements IPurchaseRepository{
    private $connection;
    private $tableName = " PURCHASE ";

    
    function GetAll()
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);
            
            $ret = Purchase::mapData($queryResult);

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

            $ret = Purchase::mapData($queryResult);

            return $ret[0];
        }catch(Exception $ex){
            throw $ex;
        }
    }


}



?>