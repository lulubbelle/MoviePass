<?php

namespace DAO;

use Models\Show as Show;
use DAO\Connection as Connection;
use \Exception as Exception;
use Interfaces\IShowRepository as IShowRepository;

class ShowRepository implements IShowRepository{

    private $connection;
    private $tableName = " SHOWS ";

    public function __construct()
    {
        $this->connection = null;
    }

    
    function GetAll()
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE ACTIVE = 1 ORDER BY ID DESC, MOVIE_ID";
            
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);

            $ret = Show::mapData($queryResult);

            return $ret;
        }catch(Exception $ex){
            throw $ex;
        }
    }
    
    function GetByCinemaId($cinemaId)
    {
        try
        {
            $ret = array();
            $query = "SELECT SH.* FROM SHOWS SH
                INNER JOIN ROOM ON ROOM.ID = SH.ROOM_ID
                INNER JOIN CINEMA CIN ON CIN.ID = ROOM.cineId
                WHERE CIN.ID = :cinemaId
                AND SH.ACTIVE = 1
                ORDER BY SH.ID DESC, SH.MOVIE_ID";
            
            $parameters['cinemaId'] = $cinemaId;

            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query, $parameters);
            
            $ret = Show::mapData($queryResult);

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

            $ret = Show::mapData($queryResult);

            return $ret[0];
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function AddOne($show){
        try
        {
            $query = 'INSERT INTO ' . $this->tableName . ' (MOVIE_ID, ROOM_ID, DATETIME_FROM, DATETIME_TO) VALUES (:movieId, :roomId, :dateTimeFrom, :dateTimeTo);';
            
            $parameters['movieId'] = $show->getMovieId();
            $parameters['roomId'] = $show->getRoomId();
            $parameters['dateTimeFrom'] = $show->getDateTimeFrom();
            $parameters['dateTimeTo'] = $show->getDateTimeTo();

            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);
            return "Función Agregada correctamente";
        }catch(Exception $ex){
            return "Ha ocurrido un error :( " . $ex->getMessage();
        }
    }

    public function DeleteShow($id){

        $sql = "UPDATE " . $this->tableName . " SET ACTIVE = 0 WHERE ID = :ID";
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

    public function Update($show){
        
        try
        {
            $sql = "UPDATE " . $this->tableName . " SET MOVIE_ID = :movieId, ROOM_ID = :roomId, DATETIME_FROM = :dateTimeFrom, DATETIME_TO = :dateTimeTo WHERE ID = :Id";
            
            $parameters['Id'] = $show->getId();
            $parameters['movieId'] = $show->getMovieId();
            $parameters['roomId'] = $show->getRoomId();
            $parameters['dateTimeFrom'] = $show->getDateTimeFrom();
            $parameters['dateTimeTo'] = $show->getDateTimeTo();
            
            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($sql, $parameters);

            return "Registro modificado correctamente";
        }
        catch(Exception $e)
        {
            return "Ha ocurrido un error :( " . $e->getMessage();
        }
    }

    public function GetByDateAndMovieId($dateFrom, $movieId){
        try
        {
            $query = "SELECT * FROM " . $this->tableName . " WHERE DATE(DATETIME_FROM) = :showDate AND MOVIE_ID = :movieId AND ACTIVE = 1 ORDER BY ID DESC, MOVIE_ID;";
             
            $parameters['showDate'] = date('Y-m-d', strtotime($dateFrom));
            $parameters['movieId'] = $movieId;
            
            $this->connection = Connection::getInstance();
            $queryResult = $this->connection->Execute($query, $parameters);

            $ret = Show::mapData($queryResult);
            
            return $ret;
        }
        catch(Exception $e)
        {
            return "Ha ocurrido un error :( " . $e->getMessage();
        }
    }
    
    public function GetByRoomIdAndMovieId($roomId, $movieId){
        try
        {
            $query = "SELECT SH.* FROM SHOWS SH
                    INNER JOIN ROOM ON ROOM.ID = SH.ROOM_ID
                    INNER JOIN CINEMA CIN ON CIN.ID = ROOM.cineId
                    WHERE MOVIE_ID = :movieId 
                    AND CIN.ID = (select cineId from room where id = :roomId)
                    AND SH.ACTIVE = 1";

            $parameters['roomId'] = $roomId;
            $parameters['movieId'] = $movieId;
            
            $this->connection = Connection::getInstance();
            $queryResult = $this->connection->Execute($query, $parameters);

            $ret = Show::mapData($queryResult);
            
            return $ret;
        }
        catch(Exception $e)
        {
            return "Ha ocurrido un error :( " . $e->getMessage();
        }
    }
    
    
    public function GetShowByDatePlusMinutes($dateFrom, $minutes){
        
        $query = "SELECT * FROM " . $this->tableName . " WHERE DATETIME_TO >= date_add( :dateFrom , interval " . -$minutes . " minute) AND DATETIME_TO <= :anotherDateFrom AND ACTIVE = 1;";
        
        $parameters['dateFrom'] = $dateFrom;
        $parameters['anotherDateFrom'] = $dateFrom;
        
        $this->connection = Connection::getInstance();
        $queryResult = $this->connection->Execute($query, $parameters);
        
        $ret = Show::mapData($queryResult);
        
        return $ret;
    }

    public function GetShowIsPlayingInDateTime($dateFrom){
        $query = "SELECT * FROM " . $this->tableName . " WHERE :dateFrom BETWEEN DATETIME_FROM and DATETIME_TO AND ACTIVE = 1;";
        
        $parameters['dateFrom'] = date('Y-m-d H:m:s', strtotime($dateFrom));
        
        $this->connection = Connection::getInstance();
        $queryResult = $this->connection->Execute($query, $parameters);
        
        $ret = Show::mapData($queryResult);
            
        return $ret;
    }

    public function ValidateDeleteRoom($roomId){
        $query = "SELECT * FROM " . $this->tableName . " WHERE ROOM_ID = :roomId AND ACTIVE = 1;";
        
        $parameters['roomId'] = $roomId;
        
        $this->connection = Connection::getInstance();
        $queryResult = $this->connection->Execute($query, $parameters);
        
        $ret = Show::mapData($queryResult);
            
        return $ret;
    }
    
    public function GetShowsByGenreAndDateRange($dateFrom, $dateTo, $genreId){

        $query = "SELECT * FROM " . $this->tableName . " WHERE DATETIME_FROM >= :dateFrom AND DATETIME_TO <= :dateTo AND ACTIVE = 1 ";
        
        if($genreId != 0){
            $query = $query . " AND MOVIE_ID IN (SELECT MOVIE_ID FROM MOVIE_GENRE WHERE GENRE_ID = :genreId)";
            $parameters['genreId'] = $genreId;
        }
        
        $parameters['dateFrom'] = $dateFrom;
        $parameters['dateTo'] = $dateTo;
        
        
        $this->connection = Connection::getInstance();
        $queryResult = $this->connection->Execute($query, $parameters);
        
        $ret = Show::mapData($queryResult);
            
        return $ret;
    }

    public function GetShowsByCinemaIdAndDateRange($dateFrom, $dateTo, $cinemaId){
        $query = "SELECT * FROM " . $this->tableName . " WHERE DATETIME_FROM >= :dateFrom AND DATETIME_TO <= :dateTo AND ACTIVE = 1 AND ROOM_ID IN (SELECT ID FROM ROOM WHERE CINEID = :cinemaId)";

        $parameters['dateFrom'] = $dateFrom;
        $parameters['dateTo'] = $dateTo;
        $parameters['cinemaId'] = $cinemaId;
        
        $this->connection = Connection::getInstance();
        $queryResult = $this->connection->Execute($query, $parameters);
        
        $ret = Show::mapData($queryResult);
            
        return $ret;
    }

}

?>