<?php

namespace DAO;

use Models\Cine as Cine;

class CineRepository{

    private $fileName = array();
    private $data = array();

    function __construct(){
        $this->fileName = DATA_PATH."Cines.json";
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getAll(){
        $this->RetrieveData();
        return $this->data;
    }

    public function Add(Cine $cine){
        $this->RetrieveData();
        
        foreach($this->data as $value){
            if($cine->getDireccion() == $value->getDireccion()){
                return "Ya existe un cine en la direccion indicada.";
            }
        }

        $cine->setId($this->GetLastId() + 1);

        array_push($this->data,$cine);
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
                $cine = new Cine();
                $cine->setId($value["id"]);
                $cine->setCapacidad($value["capacidad"]);
                $cine->setNombre($value["nombre"]);
                $cine->setValorEntrada($value["valorEntrada"]);
                $cine->setDireccion($value["direccion"]);
                $cine->setCiudad($value["ciudad"]);

                array_push($this->data, $cine);
            }
        }
    }

    private function SaveData(){
        $arrayToEncode = array();
        
        foreach($this->data as $cine){
            $values["id"] = $cine->getId();
            $values["capacidad"] = $cine->getCapacidad();
            $values["nombre"] = $cine->getNombre();
            $values["valorEntrada"] = $cine->getValorEntrada();
            $values["direccion"] = $cine->getDireccion();
            $values["ciudad"] = $cine->getCiudad();
            
            array_push($arrayToEncode, $values);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    public function DeleteCinema($id){
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
            return "Eliminado Correctamente";
        }
    }

    public function UpdateCinema($id, $cinema){
        $this->RetrieveData();
        for($i = 0; $i < \count($this->data); $i++)
        {
            if($this->data[$i]->getId() == $id){
                $this->data[$i] = $cinema;
                $ok = 1;
            }
        }
        $this->SaveData();
        if(isset($ok)){
            return "Modificado Correctamente";
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
        $errorMsg = "No se encontro un cine con el id proporcionado.";
        return $errorMsg;
    }

    public function GetByCiudad($ciudad){
        $this->data = array();
        if(file_exists($this->fileName)){

            $fileContent = file_get_contents($this->fileName);
            $arrayToDecode = ($fileContent) ? json_decode($fileContent, true) : array();

            foreach($arrayToDecode as $key => $value){
                if($value["ciudad"] == $ciudad || $ciudad == "Todos"){
                    $cine = new Cine();
                    $cine->setId($value["id"]);
                    $cine->setCapacidad($value["capacidad"]);
                    $cine->setNombre($value["nombre"]);
                    $cine->setValorEntrada($value["valorEntrada"]);
                    $cine->setDireccion($value["direccion"]);
                    $cine->setCiudad($value["ciudad"]);
    
                    array_push($this->data, $cine);
                }
            }
        }
        return $this->data;
    }

    public function getAllRoomsByCinemaId($id){
        $this->data = array();
        if(file_exists($this->fileName)){

            $fileContent = file_get_contents($this->fileName);
            $arrayToDecode = ($fileContent) ? json_decode($fileContent, true) : array();

            foreach($arrayToDecode as $key => $value){
                if($value["ciudad"] == $ciudad || $ciudad == "Todos"){
                    $room = new Room();
                    $room->setId($value["id"]);
                    $room->setCapacidad($value["capacidad"]);
                    $room->setNombre($value["nombre"]);
                    $room->setValorEntrada($value["valorEntrada"]);
                    $room->setDireccion($value["direccion"]);
                    $room->setCiudad($value["ciudad"]);
    
                    array_push($this->data, $cine);
                }
            }
        }
        return $this->data;
    }

}


?>