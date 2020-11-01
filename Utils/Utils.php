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

    public static function SanitizeString($string) {
        $clean_name = strtr($string, array('Š' => 'S','Ž' => 'Z','š' => 's','ž' => 'z','Ÿ' => 'Y','À' => 'A','Á' => 'A','Â' => 'A','Ã' => 'A','Ä' => 'A','Å' => 'A','Ç' => 'C','È' => 'E','É' => 'E','Ê' => 'E','Ë' => 'E','Ì' => 'I','Í' => 'I','Î' => 'I','Ï' => 'I','Ñ' => 'N','Ò' => 'O','Ó' => 'O','Ô' => 'O','Õ' => 'O','Ö' => 'O','Ø' => 'O','Ù' => 'U','Ú' => 'U','Û' => 'U','Ü' => 'U','Ý' => 'Y','à' => 'a','á' => 'a','â' => 'a','ã' => 'a','ä' => 'a','å' => 'a','ç' => 'c','è' => 'e','é' => 'e','ê' => 'e','ë' => 'e','ì' => 'i','í' => 'i','î' => 'i','ï' => 'i','ñ' => 'n','ò' => 'o','ó' => 'o','ô' => 'o','õ' => 'o','ö' => 'o','ø' => 'o','ù' => 'u','ú' => 'u','û' => 'u','ü' => 'u','ý' => 'y','ÿ' => 'y'));
        $clean_name = strtr($clean_name, array('Þ' => 'TH', 'þ' => 'th', 'Ð' => 'DH', 'ð' => 'dh', 'ß' => 'ss', 'Œ' => 'OE', 'œ' => 'oe', 'Æ' => 'AE', 'æ' => 'ae', 'µ' => 'u'));
        // $clean_name = pregreplace(array('/\s/', '/.[.]+/', '/[^\w.-]/'), array('_', '.', ''), $clean_name);
        $clean_name = strtolower($clean_name);
        return $clean_name;
    }

    public static function CleanInput($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripcslashes($data); #Limpia las barras invertidas anti xss
        return $data;
    }

    public static function SanitizeInput($data){
        /*$data = Utils::ClearString($data);
        $data = Utils::SanitizeString($data); #Reemplaza caracteres espesiales
        */
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