<?php
    namespace Controllers;

    use DAO\UserRepository as UserRepository;
    use Models\User as User;
    use Utils\Utils as Utils;

    class RegisterController
    {

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."register.php");
        }        

        public function RegisterUser(){
            if($_POST)
            {
                $mail = Utils::CleanInput($_POST["email"]);
                $userName = Utils::CleanInput($_POST["username"]);
                $password = Utils::CleanInput($_POST["password"]);
                $confirmpassword = Utils::CleanInput($_POST["confirmpassword"]);

                if($password !== $confirmpassword)
                {
                    $registerErrors = "Las contraseñas no coinciden";
                    require_once(VIEWS_PATH."Register.php");
                }

                $userRepo = new UserRepository();
                // $user = $userRepo->GetUserByMail($mail);
                
                // if(empty($user) || !isset($user)){
                //     $errorLogin = "Ya existe un usuario registrado con el mail indicado.";
                //     require_once(VIEWS_PATH."Register.php");
                //     exit;
                // }
                
                //Hasheamos la password
                $password =  password_hash($_POST["password"], PASSWORD_DEFAULT);

                
                $user = new User();
                $user->setMail($mail);
                $user->setUserName($userName);
                $user->setPassword($password);

                //TODO: FIX ROL HARDCODEADO
                $user->setRolId(2);
                
                $registerErrors = $userRepo->Add($user);
                if(empty($registerErrors)){
                    require_once(VIEWS_PATH."login.php");
                }else{
                    require_once(VIEWS_PATH."register.php");
                }
            }
        }
    }

?>