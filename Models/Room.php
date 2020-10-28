<?php

namespace Models;

class Room {

    private $id;
    private $cinemaId;
    private $name;
    private $capacity;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCinemaId()
    {
        return $this->cinemaId;
    }

    public function setCinemaId($cinemaId)
    {
        $this->cinemaId = $cinemaId;

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

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }
}

?>