<?php namespace DAO\BD;

use Models\Movie as Movie;
use Models\Room as Room;
use Models\Show as Show;
use DAO\DB\MoviePDO as MoviePDO;
use DAO\DB\RoomPDO as RoomPDO;
use DAO\DB\Connection as Connection;
use \PDOException as PDOException;

class ShowPDO{
    private $connection;
    public function __construct()
    {
        $this->connection = null;
    }
    public function create($show){
      
        $sql= "INSERT INTO SHOW (id,id_Movie,date,time,time_final) VALUES(:id,:id_Movie, :date, :time, :time_final)";
            $parameters['id']=$show->getRoom()->getID();
            $parameters['id_Movie']=$show->getMovie()->getID();
            $parameters['date'] =$show->getdate();
            $parameters['time'] =$show->gettime();
            $parameters['time_final'] =$show->gettime_final();

        try {
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e) {
			echo $e;
		}
    }
    
     public function retrieveOne($id) {
        $show = null;

        $parameters['id']=$id;
        try
        {
            $sql = "SELECT * FROM SHOW where id_show=:id";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql, $parameters);

            if(!empty($resultSet)) {
                $id = $resultSet[0]["id_show"];
                $id = $resultSet[0]["id"];
                $id_Movie = $resultSet[0]["id_Movie"];
                $date = $resultSet[0]["date"];
                $time = $resultSet[0]["time"];
                $time_final = $resultSet[0]["time_final"];

                $RoomDAO = new RoomPDO();
                $Room = $RoomDAO->retrieveOne($id);

                $MovieDAO = new PeliPDO();
                $Movie = $MovieDAO->retrieveOne($id_Movie);

                $show = new show($Room, $Movie, $date, $time);
                $show->setID($id);
                $show->settime_final($time_final);
                 
            }
        }
        catch(PDOException $e)
        {
            echo $e;
        }

        return $show;
    }


    public function getAll() {
        $showList = array();
            try
            {
                $query = "SELECT * FROM SHOW ";
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($query);
    
            if(!empty($resultSet)) {
                foreach($resultSet as $row) {
                    $id = $row["id_show"];
                    $date = $row["date"];
                    $time = $row["time"];
                    $time_final = $row["time_final"];
                
                    $idRoom = $row["id"];
                    $idMovie = $row["id_Movie"];
    
                    $RoomDAO = new RoomPDO();
                    $Room = $RoomDAO->retrieveOne($idRoom);

                    
    
                    $MovieDAO = new PeliPDO();
                    $Movie = $MovieDAO->retrieveOne($idMovie);
    
                    $show = new show($Room, $Movie, $date, $time);
                    $show->setID($id);
                    $show->setRoom($Room);
                    $show->setMovie($Movie);
                    $show->settime_final($time_final);
    
                    array_push($showList, $show);

                }
            }
        }
    catch (PDOException $e)
        {
            throw $e;
        }
        return $showList;
}


}


?>
