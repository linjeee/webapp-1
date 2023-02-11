<?php
require 'vendor/autoload.php';
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Spatie\Async\Pool;

require_once 'config.php';
$sql = "SELECT distinct email FROM users limit 499";
$mail_all = mysqli_query($connn, $sql);

function sendMail($subjectMails, $messageMails)
{   
   print_r($GLOBALS['mail_all']);
   if ($GLOBALS['mail_all']->num_rows > 0) {
      $pool = Pool::create();
      while ($row = $GLOBALS['mail_all']->fetch_assoc()) {
         $pool[] = async(function () use ($row, $subjectMails, $messageMails) {
            // print_r("email: " . $row["email"] . "<br>");
            $mailfrom = $GLOBALS['mailfrom'];
            $mailpass = $GLOBALS['mailpass'];
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.gmail.com'; //gmail SMTP server
            $mail->Username = $mailfrom;
            $mail->Password = $mailpass;
            $mail->Port = 465; //SMTP port
            $mail->SMTPSecure = "ssl";
            $mail->setFrom($mailfrom, $mailfrom);

            $mail->addAddress($row["email"], $row["email"]);

            // Add cc or bcc   
            // $mail->addCC('email@mail.com');  
            // $mail->addBCC('user@mail.com');  


            $mail->isHTML(true);

            $mail->Subject = $subjectMails;
            $mail->Body = $messageMails;

            // Send mail   
            if (!$mail->send()) {
               // echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
            } else {
               // echo 'Message has been sent.';
            }

            $mail->smtpClose();

         });
      }
      // await($pool);
      // echo 'Message has been sent.';
   }
}
?>