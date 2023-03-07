<!-- Otp will be sent using this page -->
<?php 
 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'confidential.php';
include 'class.php';
include 'loadin.php';
include 'class accountexists.php';
include 'class connect.php';

$_SESSION['invalidemail'] = FALSE;
$_SESSION['exists'] = TRUE;
$_SESSION['mess'] = "";
$_SESSION['account'] = "";
$_SESSION['forgot'] = false;
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
if($_SERVER['REQUEST_METHOD']=='POST'){
if(isset($_POST['recover-submit'])){
if(isset($_POST['mail'])){
$obj = new Validate();
$obj2 = new Exist();
if(!$obj->validate_email($_POST['mail'])){
  $_SESSION['invalidemail'] = TRUE;
  $_SESSION['mess'] = "Email ID is not valid";
  header('location:forgot.php');
  
  
}
elseif($obj2->account_exist($_POST['mail']) == FALSE){
  $_SESSION['exists'] = FALSE;
  $_SESSION['account'] = "Account doesnot exist";
  header('location:forgot.php');
}
else{
require 'vendor/autoload.php';
  $_SESSION['forgot'] = true;
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = $email_sender;
  $mail->Password = $email_password;
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
}
}
}
}
?>

</html>