<?php
session_start();
error_reporting(0);
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

function sentMail($email,$code,$roleurl,$p1,$p2)
{
    //Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

$mail->Username = 'angel189mavani@gmail.com';

$mail->Password = 'Angel189@';

$mail->IsHTML(true);

//Set who the message is to be sent from
$mail->setFrom($email);

//Set an alternative reply-to address
//$mail->addReplyTo('', '');

//Set who the message is to be sent to
$mail->addAddress($email);

//Set the subject line
$mail->Subject = 'Reset Password Link';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

$msg=$roleurl.$p1.$email.$p2.$code;
$mail->msgHTML($msg);

//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';


//send the message, check for errors
if (!$mail->send()) {
//    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  //  echo "Message sent!";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
// die;

}

