<?php

namespace Models;

class City {

    private $id;
    private $name;
    private $active;

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
    
    public function getActive($active)
    {
        return $this->active;
    }

    public function setActive($active){

        $this->active = $active;

        return $this;
    }

    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
   
        
        $resp = array_map(function($p){

            $city = new City();
            $city->setId($p['Id']);
            $city->setName($p['name']);
            $city->setActive($p['ACTIVE']);
            
            return $city;
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