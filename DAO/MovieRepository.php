<?php

namespace DAO;

use Models\Movie as Movie;
use DAO\Connection as Connection;
use \Exception as Exception;


class MovieRepository{

    private $connection;
    private $tableName = "MOVIE";
    
    private $data;

    public function GetAllFromApi(){
        $this->RetrieveDataFromApi();
        return $this->data;
    }

    public function GetAllFromDb(){
        $ret = array();
        $query = "SELECT * FROM " . $this->tableName;
        $this->connection = Connection::GetInstance();
        $queryResult = $this->connection->Execute($query);

        //TODO: Reemplazar con mapper
        foreach ($queryResult as $row)
        {
            $movie = new Movie();
            $movie->setId($row["ID"]);
            $movie->setIdApi($row["ID_API"]);
            $movie->setTitle($row["TITLE"]);
            $movie->setImgLink($row["IMG_PATH"]);
            $movie->setDescripcion($row["DESCRIPTION"]);
            $movie->setReleaseDate($row["RELEASE_DATE"]);
            $movie->setDirector($row["DIRECTOR"]);
            $movie->setCountry($row["COUNTRY_ID"]);

            array_push($ret, $movie);
        }

        return $ret;
    }

    private function RetrieveDataFromApi(){
        $this->data = array();

        $url = API_MAIN_LINK."movie/now_playing?api_key=".API_KEY;

        $data = file_get_contents($url);

        $array = array();
        $decoded = json_decode($data, true);
        foreach($decoded["results"] as $value){
            $movie = new Movie();
            
            $movie->setIdApi($value["id"]);
            $movie->setTitle($value["title"]);
            $movie->setImgLink($value["poster_path"]);
            $movie->setGenres($value["genre_ids"]);
            // $movie->setDescripcion($value["poster_path"]);

            array_push($this->data, $movie);
        }
    }
    
    public function GetAllByGenre($genreId){
        $this->data = array();

        $url = API_MAIN_LINK."movie/now_playing?api_key=".API_KEY;

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
}


?>