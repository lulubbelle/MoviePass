<?php

namespace DAO;

use Models\UserProfile as UserProfile;
use DAO\Connection as Connection;
use \Exception as Exception;
use Interfaces\IUserProfileRepository as IUserProfileRepository;

class UserProfileRepository implements IUserProfileRepository {

    private $connection;
    private $tableName = " user_profile ";
    private $userTable = " user ";

    public function __construct()
    {
        $this->connection = null;
    }

    public function Add($userProfile)
    {
    	try {
		$query = "INSERT INTO user_profile (user_id, first_name, last_name, dni) VALUES (:user_id, :first_name, :last_name, :dni)";
        $parameters['user_id'] = $userProfile->getUserId();
        $parameters['first_name'] = $userProfile->getFirstName();
        $parameters['last_name'] = $userProfile->getLastName();
        $parameters['dni'] = $userProfile->getDNI();
       
		
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

        $ret = UserProfile::mapData($queryResult);
        return $ret;
        }
        catch(Exception $e)
        {
			throw $e;
		}

    }


    public function updateProfileUser($id, $firstName, $lastName, $dni, $upId) {

        try
        {
            $query = "UPDATE user_profile SET first_name = :first_name, last_name = :last_name, dni = :dni WHERE id = :upId";

            $parameters['upId'] = $upId;
            $parameters['first_name'] = $firstName;
            $parameters['last_name'] = $lastName;
            $parameters['dni'] = $dni;
            
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

            return "Registro modificado correctamente";
        }
        catch(Exception $e)
        {
            return "Ha ocurrido un error :( " . $e->getMessage();
        }
    }

    public function getUserById($id){
        try
        {
            $ret = array();
            $query = "SELECT up.id, up.user_id, up.first_name, up.last_name, up.dni, u.mail, u.userName, u.password, u.rolId FROM " . $this->tableName . " as up join " . $this->userTable . " as u on (up.user_id = u.id) WHERE  user_id = :user_id;";
            $parameters['user_id'] = $id;

            $this->connection = Connection::GetInstance();
            $queryResult = $this->connection->Execute($query, $parameters);
        
        
            $ret = UserProfile::mapData($queryResult);
            
            return $ret[0];
            
        }catch(Exception $e){
            return "Ha ocurrido un error :( " . $e->getMessage();
        }
    }
    

}

?>