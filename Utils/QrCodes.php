<?php
namespace Utils;

use QRCode;

class QrCodes{

    public static function GenerateQrForPurchase($user, $show)
    {   
        require_once(ROOT.'phpqrcode/qrlib.php');

        //agrego todo el texto que va a contener el QR
        $QRCodeText = 'Estimado ' . $username->getMail() . ' Su función es el dia TA/TA/TA en tatata' . $show->getId();
                
        //el nombre del archivo se genera mediante md5 hash en base al texto de lqr
        $fileName = 'Ticket_Purchase_'. $user->getId().'_'.$show->getId().'.png';
                
        //seteo la direccion donde se almacena el QR, y la ruta de lectura
        $savingQRFilePath = QR_FOLDER_PATH.$fileName;
        $newQRFilePath = QR_FOLDER_PATH.$fileName;

        QRCode::png($QRCodeText, $savingQRFilePath);

    }
}



?>