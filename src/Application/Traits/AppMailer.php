<?php
declare(strict_types=1);

namespace App\Application\Traits;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

trait AppMailer {

   static function getMailer(){
      $mail = new PHPMailer(true);
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();
      $mail->Host       = 'mail.myhub.kz';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'mail@myhub.kz';
      $mail->Password   = ''; // SET YOUT PASSWORD
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port       = 465;
      $mail->setFrom('mail@myhub.kz', 'Myhub.kz Mailer');
      return $mail;
   }

   static function send(array $address, string $subject,
      string $body, array $attachments=[]): bool
   {
      try {
         $mail = self::getMailer();
         if(count($address) > 0){
            foreach($address as $val) $mail->addAddress($val);
         }
         if(count($attachments)){
            foreach($attachments as $val) $mail->addAttachment($val);
         }
         $mail->isHTML(true);
         $mail->Subject = $subject;
         $mail->Body    = $body;
         $mail->AltBody = $body;
         $mail->send();
         return true;
      } catch(Exception $e) {
         return false;
      }
   }
}
