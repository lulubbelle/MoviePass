<?php

namespace Controllers;

use Utils\Utils as Utils;

class ShowController{

    public function Index(){
        include_once(VIEWS_PATH."workInProgress.php");
    }

    public function ShowAddShowView(){
        
        if($_GET){
            $movieId = Utils::CleanInput($_GET['movieId']);
        }

        include_once(VIEWS_PATH."addShow.php");
    }

}

?>