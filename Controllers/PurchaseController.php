<?php
    namespace Controllers;
    
    use DAO\CinemaRepository as CinemaRepository;
    use DAO\CityRepository as CityRepository;
    use DAO\RoomRepository as RoomRepository;
    use DAO\MovieRepository as MovieRepository;
    use DAO\PurchaseRepository as PurchaseRepository;
    use DAO\ShowRepository as ShowRepository;
    use DAO\TicketRepository as TicketRepository;

    use Utils\Utils as Utils;
    use Utils\QrCodeGenerator as QrCodeGenerator;

    use Models\Purchase as Purchase;
    use Models\Show as Show;
    use Models\Ticket as Ticket;

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
                $totalPrice = $itemPrice * $cantTickets;
                
                $showRepo = new ShowRepository();
                $show = $showRepo->GetById($showId);
                $show = $this->GetShowDetails($show);
                
                include_once(VIEWS_PATH."payment.php");
            }
        }        

        private function GetShowDetails(Show $show){
        
            $movieRepo = new MovieRepository();
            $cityRepo = new CityRepository();
            $roomRepo = new RoomRepository();
            $cinemaRepo = new CinemaRepository();
    
            $movie = $movieRepo->GetById($show->getMovieId());
            $show->setMovie($movie);
    
            $city = $cityRepo->GetCityByRoomId($show->getRoomId());
            $show->setCity($city);
            
            $room = $roomRepo->GetById($show->getRoomId());
    
            $show->setRoom($room);
            
            $cinema = $cinemaRepo->GetById($show->getRoom()->getCinemaId());
    
            $show->setCinema($cinema);
            
            return $show;
        }

        public function DoPurchase(){

            Utils::CheckSession();
            if($_POST){
                
                $showId = Utils::CleanInput($_POST['showId']);
                $itemPrice = Utils::CleanInput($_POST['itemPrice']);
                $cantTickets = Utils::CleanInput($_POST['cantTickets']);


                $purchase = new Purchase();
                $purchase->setShowId($showId);
                $purchase->setUserId($_SESSION['userId']);
                $purchase->setDatePurchase(date("Y-m-d H:i:s"));

                $purchaseRepo = new PurchaseRepository();
                $createdPurchaseId = $purchaseRepo->AddOne($purchase);

                $ticketRepo = new TicketRepository();

                for($i = 0; $i < $cantTickets; $i++){
                    $ticket = new Ticket();
                    $ticket->setPurchaseId($createdPurchaseId);
                    $ticket->setQrFileName('-');
    
                    $createdTicketId = $ticketRepo->AddOne($ticket);
    
                    $fileName = QrCodeGenerator::GenerateQrForPurchase($_SESSION['userId'], $createdTicketId);
    
                    $ticketRepo->UpdateQrFileName($ticket->getId(), $fileName);
                    
                }
                
                //mandar mail

                $this->Index(null, "Felicitaciones por su compra");
                
            }
        }

    }
?>