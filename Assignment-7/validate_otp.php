<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';
include 'loadin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style5.css">
    <title>Validate OTP</title>
</head>

<body>
    <div class="container">
        <div class="items">
            <i class="fa fa-key icon_otp" aria-hidden="true"></i>
            <!-- <h2 class="otp">Enter OTP</h2> -->
            <!-- <p id="demo"></p> -->
            <div class="wrapper">
                <div class="typing-demo">
                    Enter OTP
                </div>
            </div>
            <div class="otp-input-wrapper">
                <form action="validate_otp.php" method="post">
                    <input type="text" name="otp" placeholder="" autocomplete="off" pattern="[0-9]*" maxlength="4">


                    <svg viewBox="0 0 240 1" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="0" x2="240" y2="0" stroke="#3e3e3e" stroke-width="2" stroke-dasharray="44,22" />
                    </svg>


            </div>
            <div class="sub">
                <input type="submit" name='submit' class="submit_btn">
            </div>
            </form>
            <div class="timer-icon">
                <?php
                include 'timer.php';
                ?>
            </div>
        </div>
    </div>
</body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['otp'] == $_SESSION['otp']) {
        header('location:reset.php');
    } else {
        echo "<script> alert ('Wrong OTP'); </script>";
    }
}
?>

</html>