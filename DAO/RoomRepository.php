<?php

namespace DAO;

use Models\Room as Room;

class RoomRepository{

    private $fileName = array();
    private $data = array();

    function __construct(){
        $this->fileName = DATA_PATH."Rooms.json";
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getAll(){
        $this->RetrieveData();
        return $this->data;
    }

    public function Add(Room $room){
        $this->RetrieveData();
        
        foreach($this->data as $value){
            if($room->getName() == $value->getName()){
                return "Ya existe una sala con el nombre indicado.";
            }
        }

        $room->setId($this->GetLastId() + 1);

        array_push($this->data,$room);
        $this->SaveData();  
    }
    
    public function GetLastId(){
        $this->RetrieveData();
        
        $max = 0;
        foreach($this->data as $value){
            if($value->getId() > $max){
                $max = $value->getId();
            }
        }
        return $max;
    }

    private function RetrieveData(){
        $this->data = array();
        if(file_exists($this->fileName)){

            $fileContent = file_get_contents($this->fileName);
            $arrayToDecode = ($fileContent) ? json_decode($fileContent, true) : array();

            foreach($arrayToDecode as $key => $value){
                $room = new Room();
                $room->setId($value["id"]);
                $room->setCinemaId($value["cinemaId"]);
                $room->setName($value["name"]);
                $room->setCapacity($value["capacity"]);

                array_push($this->data, $room);
            }
        }
    }

    private function SaveData(){
        $arrayToEncode = array();
        
        foreach($this->data as $room){
            $values["id"] = $room->getId();
            $values["cinemaId"] = $room->getCinemaId();
            $values["name"] = $room->getName();
            $values["capacity"] = $room->getCapacity();
            
            array_push($arrayToEncode, $values);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    public function DeleteRoom($id){
        $this->RetrieveData();
        for($i = 0; $i < \count($this->data); $i++)
        {
            if($this->data[$i]->getId() == $id){
                unset($this->data[$i]);
                $ok = 1;
            }
        }
        $this->SaveData();
        if(isset($ok)){
            return "Eliminada Correctamente";
        }
    }

    public function UpdateRoom($id, $room){
        $this->RetrieveData();
        for($i = 0; $i < \count($this->data); $i++)
        {
            if($this->data[$i]->getId() == $id){
                $this->data[$i] = $room;
                $ok = 1;
            }
        }
        $this->SaveData();
        if(isset($ok)){
            return "Modificada Correctamente";
        }
    }

    public function GetById($id){
        $this->RetrieveData();
        for($i = 0; $i < \count($this->data); $i++)
        {
            if($this->data[$i]->getId() == $id){
                return $this->data[$i];
            }
        }
        $errorMsg = "No se encontro una sala con el id proporcionado.";
        return $errorMsg;
    }

    public function getAllRoomsByCinemaId($id){
        $this->data = array();
        if(file_exists($this->fileName)){

            $fileContent = file_get_contents($this->fileName);
            $arrayToDecode = ($fileContent) ? json_decode($fileContent, true) : array();

            foreach($arrayToDecode as $key => $value){
                if($value["cinemaId"] == $id){
                    $room = new Room();
                    $room->setId($value["id"]);
                    $room->setCinemaId($value["cinemaId"]);
                    $room->setName($value["name"]);
                    $room->setCapacity($value["capacity"]);
    
                    array_push($this->data, $room);
                }
            }
        }
        return $this->data;
    }

}


?>