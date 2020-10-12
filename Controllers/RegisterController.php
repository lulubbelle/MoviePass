<?php
    namespace Controllers;

    use DAO\UserRepository as UserRepository;

    class RegisterController
    {

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."register.php");
        }        

        public function RegisterUser(){
            if($_POST)
            {
                $mail = $_POST["mail"];
                //Hasheamos la password
                $password =  password_hash($_POST["password"], PASSWORD_DEFAULT);

                $userRepo = new UserRepository();
                $registerErrors = $userRepo->CheckUserValid();
                if(empty($registerErrors)){
                    
                }else{
                    require_once(VIEWS_PATH."Register.php");
                }
            }
        }
    }

?>