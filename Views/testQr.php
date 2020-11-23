<?php 

require_once('phpqrcode/qrlib.php');

//agrego todo el texto que va a contener el QR
$QRCodeText =   'User Name: username'.
                ' - Cinema: cinemaname'.
                ' - Auditorium: auditoriumName'.
                ' - Date: functionDate'.
                ' - Tickets: ticketsPurchased';
        
//el nombre del archivo se genera mediante md5 hash en base al texto de lqr
$fileName = 'Ticket_Purchase_'.md5($QRCodeText).'.png';
        
//seteo la direccion donde se almacena el QR, y la ruta de lectura
$savingQRFilePath = QR_FOLDER_PATH.$fileName;
$newQRFilePath = QR_FOLDER_PATH.$fileName;

QRCode::png($QRCodeText, $savingQRFilePath);

if (!isset($_SESSION['qrTickets'])) {
    $_SESSION['qrTickets'] = array();
}

array_push($_SESSION['qrTickets'], $newQRFilePath);

?>