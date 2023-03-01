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
<body>
    <form action="otp.php" method = "POST">
    <input type="email" name="email" placeholder="Enter Email"><br><br>
    <input type="submit" name="submit">
    </form>
</body>
<?php 



require 'vendor/autoload.php';
 
if(isset($_POST['submit'])){
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'sandysardar1800@gmail.com';
  $mail->Password = 'halwxhsxuccltrlz';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  $mail->setFrom('sandysardar1800@gmail.com');
  $mail->addAddress($_POST['email']);
  $mail->isHTML(true);
  $otp = rand(9000,9999);
  $mail->Subject = $otp;
  $mail->Body = 'OTP';
  $mail->send();
  $_SESSION['otp'] = $otp;
  $_SESSION['email'] = $_POST['email'];
  header('location:validate_otp.php');
}
?>

</html>