<?php

namespace DAO;

//TODO: Fix Interfaces using
// use DAO\IUserRepository as IUserRepository;
use Models\User as User;

class UserRepository /*extends IUserRepository*/{

    private $fileName = array();
    private $data = array();

    function __construct(){
        $this->fileName = DATA_PATH."Users.json";
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getAll(){
        $this->RetrieveData();
        return $this->data;
    }

    public function Add(User $user){
        $this->RetrieveData();
        
        foreach($this->data as $value){
            if($user->getMail() == $value->getMail()){
                return "Ya existe un usuario registrado con el email indicado.";
            }
        }

        $user->setId($this->GetLastId() + 1);

        array_push($this->data,$user);
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

    public function GetUserByMail($mail){
        $this->RetrieveData();
        
        foreach($this->data as $value){
            if($value->getmail() === $mail){
                return $value;
            }
        }
    }

    private function RetrieveData(){
        $this->data = array();
        if(file_exists($this->fileName)){

            $fileContent = file_get_contents($this->fileName);
            $arrayToDecode = ($fileContent) ? json_decode($fileContent, true) : array();

            foreach($arrayToDecode as $key => $value){
                $user = new User();
                $user->setId($value["id"]);
                $user->setMail($value["mail"]);
                $user->setUserName($value["userName"]);
                $user->setPassword($value["password"]);
                $user->setRolId($value["rolId"]);

                array_push($this->data, $user);
            }
        }
    }

    private function SaveData(){
        $arrayToEncode = array();
        
        foreach($this->data as $user){
            $values["id"] = $user->getId();
            $values["mail"] = $user->getMail();
            $values["userName"] = $user->getUserName();
            $values["password"] = $user->getPassword();
            $values["rolId"] = $user->getRolId();
            array_push($arrayToEncode, $values);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

}


?>