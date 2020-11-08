<?php

namespace Models;
use Models\User as User;

class UserProfile extends User{
    
    private $id;
    private $userId;
    private $firstName;
    private $lastName;
    private $DNI;
   
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }


    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDNI()
    {
        return $this->DNI;
    }

    public function setDNI($DNI)
    {
        $this->DNI = $DNI;

        return $this;
    }

    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
    
        $resp = array_map(function($p){
            
            $userProfile = new UserProfile();
            
            $userProfile->setUserId($p['user_id']);
            $userProfile->setFirstName($p['first_name']);
            $userProfile->setLastName($p['last_name']);
            $userProfile->setDNI($p['dni']);
            $userProfile->setMail($p['mail']);
            $userProfile->setUserName($p['userName']);
            $userProfile->setPassword($p['password']);
            $userProfile->setRolId($p['rolId']);
            $userProfile->setId($p['id']);

            return $userProfile;
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