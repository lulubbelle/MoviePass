<?php
    namespace Controllers;
    
    use DAO\CinemaRepository as CinemaRepository;
    use DAO\CityRepository as CityRepository;
    use DAO\RoomRepository as RoomRepository;
    use Utils\Utils as Utils;

    use Models\Purchase as Purchase;

    class PurchaseController
    {
        public function Index($deleteMsg = "", $successMsg = "")
        {
            Utils::CheckSession();

            // $cineRepo = new CinemaRepository();
            // $cityRepo = new CityRepository();

            // $cinemas = $cineRepo->GetAll();

            // $cities = $cityRepo->GetAll();
            
            $purchases =  array();

            require_once(VIEWS_PATH."purchaseList.php");
        }        
        
        public function PurchaseAction()
        {
            Utils::CheckSession();
            if($_POST){
                
                $movieId = Utils::CleanInput($_POST['movieId']);
                $itemPrice = Utils::CleanInput($_POST['itemPrice']);
                $cityId = Utils::CleanInput($_POST['cityId']);
                $showId = Utils::CleanInput($_POST['showId']);
                $cantTickets = Utils::CleanInput($_POST['cantTickets']);
                $totalPrice = Utils::CleanInput($_POST['totalPrice']);
           
                include_once(VIEWS_PATH."payment.php");
            }
        }        

    }
?>