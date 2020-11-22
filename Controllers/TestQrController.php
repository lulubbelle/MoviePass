<?php
namespace Controllers;

class TestQrController{

    public function Index(){

        include(QR_LIB_PATH); 
        $text = "GEEKS FOR GEEKS"; 

        QRcode::png($text); 
        
    }
}

?>