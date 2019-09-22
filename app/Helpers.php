<?php
/**
 * Created by PhpStorm.
 * User: Dušan
 * Date: 21.9.2019.
 * Time: 00.21
 */

namespace App\Helpers;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Helpers extends SendEmailVerificationNotification
{
    public function SendMail($email, $body, $subject = "Aktivirajte nalog")
    {
        $mail = new PHPMailer(true);
        try {

            //Server settings
            //$mail->SMTPDebug = 2;          // Enable verbose debug output
            $mail->isSMTP();                 // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers

            $mail->SMTPAuth = true;
            $mail->SMTPSecure = true;
            // Enable SMTP authentication
            $mail->Username = 'phpmailer1995@gmail.com';    // SMTP username
            $mail->Password = 'dusan1995';       // SMTP password
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
            $mail->setFrom('phpmailer1995@gmail.com', "ICT Expert Quiz");
            $mail->addAddress($email);     // Add a recipient

            //Content
            $mail->isHTML(true);    // Set email format to HTML
            $mail->Subject = $subject;

            $mail->Body = $body;

            $mail->send();

            return response(null,201);
        }
        catch (QueryException $exception) {
            Log::error($exception->getMessage());
            return response(null, 409);
        }
        catch (Exception $e) {
            Log::critical('Error while sending email');
            return response(null, 500);
        }
    }
}
