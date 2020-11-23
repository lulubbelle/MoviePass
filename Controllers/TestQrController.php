<?php
namespace Controllers;

class TestQrController{

    // public function Index(){

    //     include(QR_LIB_PATH); 
    //     $text = "GEEKS FOR GEEKS"; 

    //     QRcode::png($text); 
        
    // }

    
    public function GenerateQR($userName, $cinemaName, $auditoriumName, $functionDate, $ticketsPurchased) // movi este codigo para aca porque necesito que me retorne el Qr para cargarlo en el mail
    {   
        require_once(ROOT.'phpqrcode/qrlib.php');

        //require_once(ROOT.'../QRGenerator/qrlib.php');

        //agrego todo el texto que va a contener el QR
        $QRCodeText =   'User Name: '.$userName.
                        ' - Cinema: '.$cinemaName.
                        ' - Auditorium: '.$auditoriumName.
                        ' - Date: '.$functionDate.
                        ' - Tickets: '.$ticketsPurchased;
                
        //el nombre del archivo se genera mediante md5 hash en base al texto de lqr
        $fileName = 'Ticket_Purchase_'.md5($QRCodeText).'.png';
                
        //seteo la direccion donde se almacena el QR, y la ruta de lectura
        $savingQRFilePath = IMG_PATHSAVE.$fileName;
        $newQRFilePath = IMG_PATH.$fileName;

        QRcode::png($QRCodeText, $savingQRFilePath);

        if (!isset($_SESSION['qrTickets'])) {
            $_SESSION['qrTickets'] = array();
        }

        array_push($_SESSION['qrTickets'], $newQRFilePath);
    }

}


?>