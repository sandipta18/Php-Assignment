<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="validate_otp.php" method="post">
        <input type="tel" name="otp"><br><br>
        <input type="submit" name='submit'>
    </form>
</body>
<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['submit'])){
        $otp = $_POST['otp'];
        if($otp == $_SESSION['otp']){
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sandysardar1800@gmail.com';
            $mail->Password = 'halwxhsxuccltrlz';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('sandysardar1800@gmail.com');
            $mail->addAddress($_SESSION['email']);
            $mail->isHTML(true);
            $mail->Subject = 'Credentials';
            $mail->Body = 'Username: sandipta18  Password:admin';
            $mail->send();
            header('location:index.php');
        }
        else{
            echo "Error";
        }
    }
}
?>
</html>