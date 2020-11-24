<?php
namespace DAO;

use Models\Ticket as Ticket;
use DAO\Connection as Connection;
use \Exception as Exception;
use Interfaces\ITicketRepository as ITicketRepository;


class TicketRepository implements ITicketRepository{
    private $connection;
    private $tableName = " TICKET ";

    
    public function GetAll()
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

    public function GetById($id)
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
    
    public function AddOne(Ticket $ticket){
        try
        {
            $query = 'INSERT INTO ' . $this->tableName . ' (PURCHASE_ID, QR_FILE_NAME) VALUES (:purchaseId, :qrFileName);';
           
            $parameters['purchaseId'] = $ticket->getPurchaseId();
            $parameters['qrFileName'] = $ticket->getQrFileName();

            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);

            $query = 'SELECT LAST_INSERT_ID();';
            
            $ret = $this->connection->Execute($query);
            
            return $ret[0]['LAST_INSERT_ID()'];

        }catch(Exception $ex){
            return "Ha ocurrido un error :( " . $ex->getMessage();
        }

    }

    function UpdateQrFileName($ticketId, $qrFileName){
        try
        {
            $query = 'UPDATE ' . $this->tableName . ' SET QR_FILE_NAME = :qrFileName WHERE ID = :ticketId;';
           
            $parameters['qrFileName'] = $qrFileName;
            $parameters['ticketId'] = $ticketId;

            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(Exception $ex){
            return "Ha ocurrido un error :( " . $ex->getMessage();
        }
 
    }

}



?>