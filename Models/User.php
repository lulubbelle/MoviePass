<?php

namespace Models;

class User{

    private $id;
    private $mail;
    private $userName;
    private $password;
    private $rolId;
  
    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getRolId()
    {
        return $this->rolId;
    }

    public function setRolId($rolId)
    {
        $this->rolId = $rolId;

        return $this;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
    
        $resp = array_map(function($p){
            
            $user = new User();
            $user->setId($p['id']);
            $user->setMail($p['mail']);
            $user->setUserName($p['userName']);
            $user->setPassword($p['password']);
            $user->setRolId($p['rolId']);
            
            return $user;
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