<?php
require 'vendor/autoload.php'; // Autoload Composer's dependencies

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) && isset($_POST['message'])) {
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    $mail = new PHPMailer(true);

    try {
    
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'];
        $mail->Password   = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port       = $_ENV['MAIL_PORT'];

   
        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
       
        $mail->addAddress('mayududam1999@gmail.com');
        $mail->addAddress($_ENV['MAIL_FROM_ADDRESS']);

      
        $mail->isHTML(true);
        $mail->Subject = "Lead From Chalet Website";
        $mail->Body    = $message . "<br><br> Full Name: " . $fname." ". $lname .  "<br>Email: " . $email . "<br>Phone: " . $phone ;
        
        $mail->send();
        echo 'Mail has been sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Please fill in all details';
}

