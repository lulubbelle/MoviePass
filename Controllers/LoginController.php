<?php
    namespace Controllers;

    class LoginController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }        


        public function CheckLogin()
        {
            if($_POST){
                $password = $_POST["password"];
                $username = $_POST["username"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                echo "username = " . $username . "<br>";
                echo "password = " . $password . "<br>";
                echo "hashed pw = " . $passwordHash . "<br>";

                echo "verify with asdasd = " . \password_verify("asdasd", $passwordHash) . "<br>";
            }
        }

    }
?>