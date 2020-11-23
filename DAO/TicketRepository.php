<?php
namespace DAO;

use Models\Ticket as Ticket;
use DAO\Connection as Connection;
use \Exception as Exception;
use Interfaces\ITicketRepository as ITicketRepository;


class TicketRepository implements ITicketRepository{
    private $connection;
    private $tableName = " TICKET ";

    
    function GetAll()
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);
            
            $ret = Ticket::mapData($queryResult);

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

            $ret = Ticket::mapData($queryResult);

            return $ret[0];
        }catch(Exception $ex){
            throw $ex;
        }
    }


}



?>