<?php

namespace DAO;

use Models\Movie as Movie;

class MovieRepository{

    private $data;

    public function getAllFromApi(){
        $this->RetrieveDataFromApi();
        return $this->data;
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

        // private $id;
        // private $idApi;
        // private $title;
        // private $imgLink;
        // private $genres;
        // private $descripcion;
        // private $releaseDate;
        // private $director;
        // private $country;
        // private $clasificacion;
        // private $isPlaying;
    }

}


?>