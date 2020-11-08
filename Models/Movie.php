<?php

namespace Models;

class Movie{

    private $id;
    private $idApi;
    private $title;
    private $imgLink;
    private $genres;
    private $description;
    private $duration;
    private $budget;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getIdApi()
    {
        return $this->idApi;
    }

    public function setIdApi($idApi)
    {
        $this->idApi = $idApi;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getImgLink()
    {
        return $this->imgLink;
    }

    public function setImgLink($imgLink)
    {
        $this->imgLink = $imgLink;

        return $this;
    }

    public function getGenres()
    {
        return $this->genres;
    }

    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    public function getBudget()
    {
        return $this->budget;
    }

    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    
    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
   
        $resp = array_map(function($p){
            
            $movie = new Movie();
            $movie->setId($p["ID"]);
            $movie->setIdApi($p["API_ID"]);
            $movie->setTitle($p["TITLE"]);
            $movie->setImgLink($p["POSTER_PATH"]);
            $movie->setDescription($p["DESCRIPTION"]);
            $movie->setDuration($p["DURATION"]);
            $movie->setBudget($p["BUDGET"]);
    
            
            return $movie;
        }, $value);

        if($resp != null){
            //return count($resp) > 1 ? $resp : $resp[0];
            return $resp;
        }
        else
        return array();
    }

}

?>