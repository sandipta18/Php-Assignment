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

    <title>Validate OTP</title>
</head>

<body>
    <form action="validate_otp.php" method="post">
        <input type="tel" name="otp" placeholder="Enter OTP"><span><?php echo $error; ?></span>
        <br><br>
        <input type="submit" name='submit'>
    </form>


</body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['otp'] == $_SESSION['otp']) {
        header('location:reset.php');
    } else {
        $error = 'wrong otp';
    }
}
?>

</html>
<?php 
include 'timer.php';
?>