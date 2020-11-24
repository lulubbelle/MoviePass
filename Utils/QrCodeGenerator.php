<?php
namespace Utils;

use QRCode;

class QrCodeGenerator{

    public static function GenerateQrForPurchase($userId, $ticketId)
    {   
        require_once(ROOT.'phpqrcode/qrlib.php');

        //agrego todo el texto que va a contener el QR
        $QRCodeText = 'http://localhost.com/show?=UserId=1?showId=2';
                
        //el nombre del archivo se genera mediante md5 hash en base al texto de lqr
        $fileName = 'Ticket_Purchase_'. $userId.'_'.$ticketId.'.png';
                
        //seteo la direccion donde se almacena el QR, y la ruta de lectura
        $savingQRFilePath = QR_FOLDER_PATH.$fileName;

        QRCode::png($QRCodeText, $savingQRFilePath);

        return $fileName;
    }
}



?>