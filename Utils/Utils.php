<?php
namespace Utils;

class Utils{


    public static function CheckAdmin(){
        $esAdmin = $_SESSION["esAdmin"];
        if (isset($_SESSION["esAdmin"]) && !$esAdmin) {
            //redirect to homepage
            header("location:".FRONT_ROOT);
        
            //exit previene que se ejecute el codigo que continuaría
            exit;
        }
    }

    
    public static function CheckSession(){
        if (!isset($_SESSION["userId"])) {
            //redirect to homepage
            header("location:".FRONT_ROOT."Login");
        }
    }

}



?>