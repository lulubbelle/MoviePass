<?php

namespace Models;

class Genre{

    private $id;
    private $name;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
    
        $resp = array_map(function($p){
            
            $genre = new Genre();
            $genre->setId($p['id']);
            $genre->setName($p['name']);
            
            return $genre;
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