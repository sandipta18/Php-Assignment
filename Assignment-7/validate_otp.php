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
    <title>Validate OTP</title>
    <style>
        .otp-input-wrapper {
            width: 240px;
            text-align: left;
            display: inline-block;
        }

        .otp-input-wrapper input {
            padding: 0;
            width: 264px;
            font-size: 32px;
            font-weight: 600;
            color: #3e3e3e;
            background-color: transparent;
            border: 0;
            margin-left: 12px;
            letter-spacing: 48px;
            font-family: sans-serif !important;
        }

        .otp-input-wrapper input:focus {
            box-shadow: none;
            outline: none;
        }

        .otp-input-wrapper svg {
            position: relative;
            display: block;
            width: 240px;
            height: 2px;
        }
    </style>
</head>

<body>
    Enter OTP<br>
    <div class="otp-input-wrapper">
        <form action="validate_otp.php" method="post">
            <input type="text" name="otp" placeholder="" autocomplete="off" pattern="[0-9]*" maxlength="4">
            <br><br>

            <svg viewBox="0 0 240 1" xmlns="http://www.w3.org/2000/svg">
                <line x1="0" y1="0" x2="240" y2="0" stroke="#3e3e3e" stroke-width="2" stroke-dasharray="44,22" />
            </svg>


    </div>
    <input type="submit" name='submit'>
    </form>


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
<?php
include 'timer.php';
?>