<?php

namespace DAO;

//use Interfaces\IUserRepository as IUserRepository;
use Models\User as User;
use DAO\Connection as Connection;
use \Exception as Exception;

//class UserRepository extends IUserRepository{
class UserRepository {

    private $connection;
    private $tableName = " user ";

    public function __construct()
    {
        $this->connection = null;
    }

    public function Add($user)
    {
    	try {
		$query = "INSERT INTO USER (id, mail, username, password, rolId) VALUES (:id, :mail, :username, :password, :rolId)";
        $parameters['id'] = $user->getId();
        $parameters['mail'] = $user->getMail();
        $parameters['username'] = $user->getUserName();
        $parameters['password'] = $user->getPassword();
        $parameters['rolId'] = $user->getRolId();
       
		
            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            return "Usuario creado con éxito!";
        }
        catch(Exception $ex) {
            $errorMsg = $ex->getMessage();
            if(stripos($errorMsg, USER_UNIQUE_MAIL_IX) != false ){
                return "Ya existe un usuario creado con el mail indicado.";
            }else
                return "Ha ocurrido un error :( " . $errorMsg;
        }
	}

    public function GetAll()
    {
        try
        {
        $query = "SELECT * FROM " . $this->tableName;
        $this->connection = Connection::GetInstance();
        $queryResult = $this->connection->Execute($query);

        $ret = User::mapData($queryResult);
        return $ret;
        }
        catch(Exception $e)
        {
			throw $e;
		}

    }

    public function GetUserByMail($mail)
    {
        try
        {
        
        $query = "SELECT * FROM " . $this->tableName . " WHERE mail = :mail;";
        $parameters['mail'] = $mail;
        
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query, $parameters);

        $ret = User::mapData($resultSet);
        
        return count($ret) > 0 ? $ret[0] : null;
        
        }
        catch(Exception $e)
        {
            return "Ha ocurrido un error :( " . $e->getMessage();
        }
    }

    public function GetById($id)
    {
        try
        {
            $ret = array();
            $query = "SELECT * FROM " . $this->tableName . " WHERE ID = " . $id . ";";
            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query);

            $ret = User::mapData($queryResult);
            return $ret[0];
        }catch(Exception $e){
            return "Ha ocurrido un error :( " . $e->getMessage();
        }
    }


    public function Update($id,$password)
    {
    try
      {
      $query = "UPDATE USER SET password = :password  WHERE id = :id";
      $parameters['id'] = $id;
      $parameters['password'] = $password;
      
        $this->connection = Connection::getInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);
        return "Registro modificado correctamente";
      }
      catch(Exception $e)
      {
        return "Ha ocurrido un error :( " . $e->getMessage();
      }
    }
    

    public function Delete($mail)
    {
        try
        {
        $query = "DELETE FROM USER WHERE mail = :mail";
        $parameters['mail'] = $mail;
        
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $e)
        {
            echo $e;
        }
   }

}

?>