<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("_include.php");

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

$responsable = CONFIG['EMAIL_RESPONSABLE'];
$client = $_POST["email"];

$sujet = $_POST["sujet"];
$message = "Bonjour ".$_POST["nom"]." ".$_POST["prenom"]."<br/>";
$message.=$_POST["message"];


function envoyerEmail($responsable, $client, $sujet, $message){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = CONFIG['SERVER'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = CONFIG['LOGIN'];                     //SMTP username
        $mail->Password   = CONFIG['MDP'];                              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom(CONFIG['LOGIN']);
        $mail->addAddress($responsable);
        $mail->addAddress($client);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $sujet;
        $mail->Body    = $message;

        $mail->send();
        echo 'Message has been sent';

        header('Location: index.php');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


envoyerEmail($responsable, $client, $sujet, $message);

