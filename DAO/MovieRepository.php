<?php

namespace DAO;

use Models\Movie as Movie;
use DAO\Connection as Connection;
use \Exception as Exception;
use Interfaces\IMovieRepository as IMovieRepository;


class MovieRepository implements IMovieRepository{

    //BBDD
    private $connection;
    private $tableName = " MOVIE ";
    
    //Api
    private $data;

    function GetAll()
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE ACTIVE = 1";
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);
            
            $ret = Movie::mapData($queryResult);

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

            $ret = Movie::mapData($queryResult);

            return $ret[0];
        }catch(Exception $ex){
            throw $ex;
        }
    }

    function GetByApiId($id)
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE API_ID = :id ;";
            $parameters['id'] = $id;
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query, $parameters);

            $ret = Movie::mapData($queryResult);

            return $ret[0];
        }catch(Exception $ex){
            throw $ex;
        }
    }
    
    public function GetAllFromApi(){
        $this->RetrieveDataFromApi();
        return $this->data;
    }

    private function RetrieveDataFromApi(){
        $this->data = array();

        $url = API_MAIN_LINK.API_NOW_PLAYING.API_KEY;

        $data = file_get_contents($url);

        $array = array();
        $decoded = json_decode($data, true);
        foreach($decoded["results"] as $value){
            $movie = new Movie();

            $movie->setIdApi($value["id"]);
            $movie->setTitle($value["title"]);
            $movie->setImgLink($value["poster_path"]);
            $movie->setGenres($value["genre_ids"]);
            $movie->setDescription($value["overview"]);

            $url = "http://api.themoviedb.org/3/movie/". $value["id"] . "?api_key=601a788e05e35017d437dd9ad9c368c0";
            $details = file_get_contents($url);
            $detailsDecoded = json_decode($details, true);

            $movie->setDuration($detailsDecoded["runtime"]);
            $movie->setBudget($detailsDecoded["budget"]);
            
            array_push($this->data, $movie);
        }
        
        //Utilicé este metodo para hacer el insert en la BBDD para no hacerlo a mano
        //Lo dejo comentado por las dudas que se necesite hacer lo mismo en un futuro

        // foreach($this->data as $movie){
            
        //     $query= "INSERT INTO " . $this->tableName . " (TITLE, POSTER_PATH, API_ID, DESCRIPTION, DURATION, BUDGET) VALUES(:title, :poster_path, :api_id, :description, :duration, :budget)";

        //     $parameters['title'] = $movie->getTitle();
        //     $parameters['poster_path'] = $movie->getImgLink();
        //     $parameters['api_id'] = $movie->getIdApi();
        //     $parameters['description'] = $movie->getDescription();
        //     $parameters['duration'] = $movie->getDuration();
        //     $parameters['budget'] = $movie->getBudget();

        //     $this->connection = Connection::getInstance();
        //     $this->connection->ExecuteNonQuery($query, $parameters);
            
        //     $movieBBDD = $this->GetByApiId($movie->getIdApi());
            
        //     foreach($movie->getGenres() as $value){
        //         $genreQuery = "INSERT INTO MOVIE_GENRE (MOVIE_ID, GENRE_ID) VALUES(:movieId, :genreId)";
        //         $genreParameters['movieId'] = $movieBBDD->getId();
        //         $genreParameters['genreId'] = $value;
                
        //         $this->connection = Connection::getInstance();
        //         $this->connection->ExecuteNonQuery($genreQuery, $genreParameters);
                
        //     }
        // }
        // echo "Peliculas agregadas ok";
        // exit;
    }
    
    public function GetAllByGenreFromApi($genreId){
        $this->data = array();

        $url = API_MAIN_LINK.API_NOW_PLAYING.API_KEY;

        $data = file_get_contents($url);

        $array = array();
        $decoded = json_decode($data, true);
        foreach($decoded["results"] as $value){
            if(array_search($genreId, $value["genre_ids"]) || $genreId == 0){
                $movie = new Movie();
            
                $movie->setIdApi($value["id"]);
                $movie->setTitle($value["title"]);
                $movie->setImgLink($value["poster_path"]);
                $movie->setGenres($value["genre_ids"]);

                array_push($this->data, $movie);
            }
            
        }
        return $this->data;
    }

    public function GetAllByGenre($genreId){

        if($genreId == 0) { return $this->GetAll(); }

        try
        {
            $ret = array();
            $query = "SELECT * FROM MOVIE MO" . 
                        " INNER JOIN MOVIE_GENRE MG ON MG.MOVIE_ID = MO.ID" . 
                        " WHERE MG.GENRE_ID = :genreId";
            $parameters['genreId'] = $genreId;
            // var_dump($genreId);
            // exit;
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query, $parameters);
            
            $ret = Movie::mapData($queryResult);

            return $ret;
        }catch(Exception $ex){
            throw $ex;
        }
    }


}


?>