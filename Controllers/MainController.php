<?php

namespace Controllers;

class MainController{

    // public $DAO;
    // public function __construct(){
    //     $this->DAO = new DAO();
    // }

    public function Index(){
        
        $url = API_MAIN_LINK."movie/now_playing?api_key=".API_KEY;
        
        $data = file_get_contents($url);
        
        include_once(VIEWS_PATH."main.php");
    }
}
?>