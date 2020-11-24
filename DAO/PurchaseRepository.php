<?php
namespace DAO;

use Models\Purchase as Purchase;
use DAO\Connection as Connection;
use \Exception as Exception;
use Interfaces\IPurchaseRepository as IPurchaseRepository;


class PurchaseRepository implements IPurchaseRepository{
    private $connection;
    private $tableName = " PURCHASE ";

    
    public function GetAll()
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

    public function GetById($id)
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

    public function AddOne(Purchase $purchase){
        try
        {
            $query = 'INSERT INTO ' . $this->tableName . ' (SHOW_ID, USER_ID, DATE_PURCHASE) VALUES (:showId, :userId, :datePurchase);';
           
            $parameters['showId'] = $purchase->getShowId();
            $parameters['userId'] = $purchase->getUserId();
            $parameters['datePurchase'] = $purchase->getDatePurchase();

            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);

            $query = 'SELECT LAST_INSERT_ID();';
            
            $ret = $this->connection->Execute($query);
            
            return $ret[0]['LAST_INSERT_ID()'];

        }catch(Exception $ex){
            return "Ha ocurrido un error :( " . $ex->getMessage();
        }

    }
}



?>