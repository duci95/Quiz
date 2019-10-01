<?php


namespace App;


use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;

class Helpers
{
    public static function sendMail($email, $body, $subject) :void
    {

        $mail = new PHPMailer(true);
        try {

            //Server settings
            $mail->SMTPDebug = 2;          // Enable verbose debug output
            $mail->isSMTP();                 // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers

            $mail->SMTPAuth = true;
            $mail->SMTPSecure = true;
            // Enable SMTP authentication
            $mail->Username = 'ictexpertquiz@gmail.com';    // SMTP username
            $mail->Password = '$dusan1995$';       // SMTP password
            $mail->SMTPSecure = 'tls';           // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                   // TCP port to connect to

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //Recipients
            $mail->setFrom('ictexpertquiz@gmail.com', "ICT Expert Quiz");
            $mail->addAddress($email);     // Add a recipient

            //Content
            $mail->isHTML(true);    // Set email format to HTML
            $mail->Subject = $subject;

            $mail->Body = $body;

            $mail->send();

        }
        catch (QueryException $exception) {
            Log::error($exception->getMessage());
        }
        catch (Exception $e) {
            Log::critical('Error while sending email');
        }
    }


}
