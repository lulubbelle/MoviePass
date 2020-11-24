<?php
namespace PHPMailer;
require_once 'PHPMailer.php';
require_once 'SMTP.php';
require_once 'Exception.php';


use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    private static function InitMail($destinationMail){
        $mail = new PHPMailer();
        
        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.gmail.com:465'; //tls://smtp.gmail.com:587
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_MP;
        $mail->Password = MAIL_PASS;
        $mail->Port = '465'; //587
        $mail->SMTPSecure = 'ssl'; //tls

        //EMAIL Settings
        $mail->isHTML(true);
        $mail->setFrom('no-reply-info.moviepass@gmail.com');
        $mail->addAddress($destinationMail);

        return $mail;
    }

    public static function SendRegisterMail($user, $userProfile)
    {
        $mail = Mail::InitMail($user->getMail());
                
        $mail->Subject = 'Bienvenido a MoviePass !!';
        $mail->Body = 'Estimado ' . $userProfile->getFirstName(). ' ' . $userProfile->getLastName() . ', bienvenido a MoviePass!';

        if ($mail->send())
            return true;
        else
            return false;
    }

    public static function SendPurchaseMail($userName, $email)
    {
    
        $mail = Mail::InitMail($email);
                
        $mail->Subject = 'Gracias por su compra !!';
        $mail->Body = 'Estimado ' . $userName . ' , usted adquirió tickets para una función en MoviePass. Si desea verificar su entrada, ingrese al sitio web!';
      
        if ($mail->send())
            return true;
        else
            return false;
    }

}
