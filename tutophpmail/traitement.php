<?php

//On récupère les variables du tableau post
$nom = $_POST['name'];
$email= $_POST['email'];
$message =$_POST['message'];

//Création du message (La manière dont vous voulez qu'il soit sur votre boite mail. Libre choix à vous pour le style)
$message = "Nom : ".$nom."\n"." Email : ".$email."\n"." message : ".$message;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//On importe les fichiers importants de PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                         //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';    //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'email pour envoi'; //SMTP username (email utilisé pour envoyer le formulaire. Il doit etre celui de la validation en deux étapes et de création de mot de passe application !)
    $mail->Password   = 'mot de passe application'; // SMTP password (regarder la vidéo pour voir comment avoir ce mot de passe)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
    $mail->Port       = 465;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'ici mettre un nom quelconque');
    $mail->addAddress('email où vous recevez les formulaires envoyes');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}