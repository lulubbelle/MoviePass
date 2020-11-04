<?php
    namespace Controllers;

    use DAO\UserRepository as UserRepository;
    use Utils\Utils as Utils;

    class LoginController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }        


        public function CheckLogin()
        {
            if($_POST){
                $password = Utils::CleanInput($_POST["password"]);
                $username = Utils::CleanInput($_POST["email"]);

                $userRepo = new UserRepository();
                $user = $userRepo->GetUserByMail($username);
               
                if(empty($user) || !isset($user)){
                    $errorLogin = "Los datos ingresados no son validos.";
                    require_once(VIEWS_PATH."login.php");
                }
                $valid = \password_verify($password, $user->getPassword());

                if($valid){
                    \session_destroy();
                    session_start();
                    $_SESSION["userId"] = $user->getId();
                    $_SESSION["username"] = $user->getUsername();
                    $_SESSION["esAdmin"] = $user->getRolId() == 1;
                    require_once(VIEWS_PATH."main.php");
                }else{
                    $errorLogin = "Los datos ingresados no son validos.";
                    require_once(VIEWS_PATH."login.php");
                }
                
            }
        }

        public function CloseSession(){
            \session_destroy();
            $this->Index();
        }

    }
?>