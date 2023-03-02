<?php 
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery Window</title>
</head>
<?php 



require 'vendor/autoload.php';

  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'sandiptasardar99@gmail.com';
  $mail->Password = 'josixxrpxqknyzsy';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  $mail->setFrom('sandiptasardar99@gmail.com');
  $mail->addAddress($_POST['mail']);
  $mail->isHTML(true);
  $otp = rand(9000,9999);
  $mail->Subject = 'OTP';
  $mail->Body = $otp;
  $mail->send();
  $_SESSION['otp'] = $otp;
  $_SESSION['email'] = $_POST['mail'];
  header('location:validate_otp.php');

?>

</html>