<?php

namespace Controllers;

use Utils\Utils as Utils;
use DAO\MovieRepository as MovieRepository;
use DAO\CityRepository as CityRepository;

class ShowController{

    public function Index(){

        if($_GET){

        }

        include_once(VIEWS_PATH."addShow.php");
    }

    public function ShowAddShowView(){

        if($_GET){
            $movieId = Utils::CleanInput($_GET['movieId']);
            
            $movieRepo = new MovieRepository();
            $movie = $movieRepo->GetById($movieId);
            
            $cityRepo = new CityRepository();
            $cities = $cityRepo->GetAll();

            include_once(VIEWS_PATH."addShow.php");
    
        }
    }

    public function TestAjax(){
        $param = $_REQUEST["req"];
    }


}

?>