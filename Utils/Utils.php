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

    public static function CleanInput($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripcslashes($data); #Limpia las barras invertidas anti xss
        return $data;
    }

    public static function GenerateAntiCsrfToken(){
        $tok = md5(uniqid(rand(), TRUE));
        return $tok;
    }

    public static function ValidatePositiveNumber($number){
        return $number > 0;
    }

}



?>