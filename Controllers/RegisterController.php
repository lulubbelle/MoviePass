<?php
    namespace Controllers;

    use DAO\UserRepository as UserRepository;
    use DAO\UserProfileRepository as UserProfileRepository;
    use Models\User as User;
    use Models\UserProfile as UserProfile;
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
                $first_name = Utils::CleanInput($_POST["first_name"]);
                $last_name = Utils::CleanInput($_POST["last_name"]);
                $dni = Utils::CleanInput($_POST["dni"]);
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
                
                $userProfileRepo = new UserProfileRepository();
                $userProfile = new UserProfile();
                $userMail = $userRepo->GetUserByMail($mail);
                
                $userProfile->setUserId($userMail->getId());
                $userProfile->setFirstName($first_name);
                $userProfile->setLastName($last_name);
                $userProfile->setDNI($dni);


               
                
                
               
                
                $registerProfile = $userProfileRepo->Add($userProfile);

                if(empty($registerErrors)){
                    require_once(VIEWS_PATH."login.php");
                }else{
                    require_once(VIEWS_PATH."register.php");
                }
            }
        }
    }

?>