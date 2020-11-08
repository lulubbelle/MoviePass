<?php

namespace DAO;

//use Interfaces\IUserRepository as IUserRepository;
use Models\User as User;
use DAO\Connection as Connection;
use \Exception as Exception;

//class UserRepository extends IUserRepository{
class UserRepository {

    private $connection;
    private $tableName = " USER ";

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
        catch(Exception $e) {
            return "Ha ocurrido un error :( " . $e->getMessage();
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
        
        return $ret[0];
        
        }
        catch(Exception $e)
        {
            echo '<script>';
            echo 'console.log("Error en base de datos. Archivo: UserRepository.php")';
            echo '</script>';
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
            throw $e;
            echo '<script>';
            echo 'console.log("Error en base de datos. Archivo: userdao.php")';
            echo '</script>';
        }
    }


    public function Update($id,$password)
    {
    try
      {
      $query = "UPDATE USER SET password = :password  WHERE id = :id";
      $parameters['id'] = $id;
      $parameters['password'] = $password;
      
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);
        return "Registro modificado correctamente";
      }
      catch(Exception $e)
      {
        return "Ha ocurrido un error :( " . $e->getMessage();
      }
    }

    public function updateUserName($id, $userName) {
        try
        {
        $query = "UPDATE USER SET userName=:userName WHERE id=:id";
        $parameters['id'] = $id;
        $parameters['userName'] = $userName;
  
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            return "Nombre modificado correctamente";
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