<?php

namespace Models;

class Movie{

    private $id;
    private $idApi;
    private $title;
    private $imgLink;
    private $genres;
    private $descripcion;
    private $releaseDate;
    private $director;
    private $country;
    private $clasificacion;
    private $isPlaying;

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

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }


    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }


    public function getDirector()
    {
        return $this->director;
    }

    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function getClasificacion()
    {
        return $this->clasificacion;
    }

    public function setClasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;

        return $this;
    }

    public function getIsPlaying()
    {
        return $this->isPlaying;
    }

    public function setIsPlaying($isPlaying)
    {
        $this->isPlaying = $isPlaying;

        return $this;
    }
}

?>