<?php

namespace Controllers;

use Utils\Utils as Utils;

class ShowController{

    public function Index(){

        if($_GET){

        }

        include_once(VIEWS_PATH."addShow.php");
    }

    public function ShowAddShowView(){

        if($_GET){

        }

        include_once(VIEWS_PATH."addShow.php");
    }

}

?>