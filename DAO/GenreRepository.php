<?php

namespace DAO;

use Models\Genre as Genre;
use Interfaces\IGenreRepository as IGenreRepository;

class GenreRepository implements IGenreRepository{
    private $connection;
    private $tableName = " GENRE ";

    public function __construct()
    {
        $this->connection = null;
    }

    function GetAll()
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName;
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);
            
            $ret = Genre::mapData($queryResult);

            return $ret;
        }catch(Exception $ex){
            throw $ex;
        }
    }
}


?>