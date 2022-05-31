<?php
//Include required php mailer
require 'include/PHPMailer.php';
require 'include/SMTP.php';
require 'include/Exception.php';
require 'include/OAuth.php';
//Define name spaces
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function send_message(string $to = null, $body, $head = "Scolarix", $title)
{
    //Create instance of phpmailer
    $mail = new PHPMailer();
    //Set mailer to use smtp
    $mail->isSMTP();
    //define smtp host
    $mail->Host = "smtp.gmail.com";
    //enable smtp authentication
    $mail->SMTPAuth = true;
    //set type of enccryption
    $mail->SMTPSecure = "tls";
    //set port to connect smtp
    $mail->Port = 587;
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Priority = 1;
    //set gmail username
    $mail->Username = "devcarle@gmail.com";
    //set gmail password
    $mail->Password = "arycysrkbhderyzd";
    //set email subject
    $mail->Subject = $title;
    //set sender email
    $mail->SetFrom("devcarle@gmail.com", $head);
    //Enable HTML
    $mail->isHTML(true);
    //Email attachement
    $mail->addAttachment('');
    //email body
    $mail->Body = $body;
    //add recipient
    $mail->addAddress($to);
    //finally send mail
    $mail->Send();
    //closing smtp connection
    $mail->smtpClose();
    # code...
}
