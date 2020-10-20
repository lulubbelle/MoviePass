<?php

namespace DAO;

use Models\Genre as Genre;

class GenreRepository{

    private $fileName = array();
    private $data = array();

    function __construct(){
        $this->fileName = DATA_PATH."Genres.json";
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getAll(){
        $this->RetrieveData();
        return $this->data;
    }

    private function RetrieveData(){
        $this->data = array();
        if(file_exists($this->fileName)){

            $fileContent = file_get_contents($this->fileName);
            $arrayToDecode = ($fileContent) ? json_decode($fileContent, true) : array();

            foreach($arrayToDecode as $key => $value){
                $genre = new Genre();
                $genre->setId($value["id"]);
                $genre->setName($value["name"]);

                array_push($this->data, $genre);
            }
        }
    }
}


?>