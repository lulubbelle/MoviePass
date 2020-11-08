<?php

namespace Controllers;
use DAO\UserRepository as UserRepository;
use DAO\UserProfileRepository as UserProfileRepository;
use Models\User as User;
use Utils\Utils as Utils;
use Controllers\HomeController as HomeController;


class ProfileController{

    private $userRepository;
    private $userProfileRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->userProfileRepository = new UserProfileRepository();
    }

    public function Index(){
        $userId = $_SESSION["userId"];
        $user = $this->userRepository->getById($userId);
        $profile = $this->userProfileRepository->getUserById($userId);
        include_once(VIEWS_PATH."userView.php");
    }

    public function UpdateUserShowView(){
        $userId = $_SESSION["userId"];
        $profile = $this->userProfileRepository->getUserById($userId);
        include_once(VIEWS_PATH."userAbm.php");
       
    }

    public function UpdateUser(){
        if ($_POST){

            $user_name = Utils::CleanInput($_POST['user_name']);
            $first_name = Utils::CleanInput($_POST['first_name']);
            $last_name = Utils::CleanInput($_POST['last_name']);
            $dni = Utils::CleanInput($_POST['dni']);
            $id = Utils::CleanInput($_POST['user_id']);
            $upId = Utils::CleanInput($_POST['user_profile_id']);
            
            $this->userRepository->updateUserName($id, $user_name);

            $userProfileRepo = new UserProfileRepository();
            $userProfileRepo->updateProfileUser($id, $first_name, $last_name, $dni, $upId);
           
            $_SESSION['username'] = $user_name;
            $this->Index();
        }
    }



    
}

?>

 
