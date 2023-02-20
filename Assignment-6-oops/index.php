<?php
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 6</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>



<?php

$good = 0;
class Name
{
    function validate_input()
    {
        global $good;
        global $errname;
        global $errsurname;
        global $name;
        global $surname;
        global $temp;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["fname"])) {
                $errname = " * Name is Required";
                $good = 0;
            } else {
                $tempname = ($_POST["fname"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/", $tempname)) {
                    $errname = " * Only letters and white space allowed";
                    $good = 0;
                } else {
                    $good = 1;
                    $name = $tempname;
                }
            }

            if (empty($_POST["lname"])) {
                $errsurname = " * Surname is Required";
                $good = 0;
            } else {
                $tempsurname = ($_POST["lname"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/", $tempsurname)) {
                    $errsurname = " * Only letters and white space allowed";
                    $good = 0;
                } else {
                    $surname = $tempsurname;
                    $good = 1;
                }
            }
        }
        $name = array($name, $surname, $errname, $errsurname);
        return $name;
    }
}
class Image
{
    function validate_image()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            global $good;
            $imagename = $_FILES['image']['name'];
            $tempname = $_FILES['image']['tmp_name'];
            $imagesize = $_FILES['image']['size'];
            $errimage = "";
            //If there's no image name that means that no image was uploaded so displaying error
            if (!$imagename) {
                $errimage = "Enter an image to proceed";
                $good = 0;
            }
            //If image size is greater than 6MB
            else if ($imagesize > 6000000) {
                $errimage = "Enter image less than 6MB";
                $good = 0;
            }
            //If everything is good proceed
            elseif ($imagename != 0) {
                $good = 1;
                $path = "images/" . $imagename;
                move_uploaded_file($tempname, $path);



            }
        }
        $img = array($path, $errimage);
       // return $path;
        return $img;
    }
}
class Phone
{
    function validate_phone()
    {
        global $number_validated;
        global $errphone;
        global $good;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $number = $_POST["mobile"];
            if (preg_match("/^[+91]{3}[0-9]{10}$/", $number)) {
                $number_validated = $number;
                $good = 1;
            } else {
                $errphone = " Enter Number in valid format";
                $good = 0;
            }
        }
        $phone = array($number_validated, $errphone);
        return $phone;
    }

}
class Email
{

    function validate_email()
    {
        global $good;
        global $erremail;
        global $email_validated;
        $curl = curl_init();
        $em = $_POST["mail"];
        curl_setopt_array(
            $curl,
            array(

                CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $em,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: text/plain",
                    "apikey: EgFVIMYLC78KM6VD65HlOY6k5VpA0CTB"
                ),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            )
        );

        $response = curl_exec($curl);
        $validationResult = json_decode($response, true);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["mail"])) {
                $erremail = "Enter Email";
                $good = 0;
            }
            if (!$validationResult['format_valid'] && !$validationResult['smtp_check']) {
                $erremail = "Enter Email in valid format";
                $good = 0;
            }
            if ($validationResult['format_valid'] && $validationResult['smtp_check']) {
                $email_validated = $em;
                $good = 1;
            }

            curl_close($curl);
        }
        $email = array($email_validated, $erremail);
        return $email;
    }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") { //Created an object to call the function inside the class for validation
    $obj = new Name();
    global $temp;
    $temp = $obj->validate_input();
}

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") { //Created an object to call the function inside the class for validation
    $obj2 = new Image();
    global $image_info;
    $image_info = $obj2->validate_image();

}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") { //Created an object to call the function inside the class for validation
    $obj4 = new Phone();
    global $temp2;
    $temp2 = $obj4->validate_phone();
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") { //Created an object to call the function inside the class for validation
    $obj5 = new Email();
    global $temp3;
    $temp3 = $obj5->validate_email();
}
?>
<?php
$_SESSION["fname"] = ucwords(strtolower($temp[0]));
$_SESSION["lname"] = ucwords(strtolower($temp[1]));
$_SESSION["mobile"] = $temp2[0];
$_SESSION["mail"] = $temp3[0];
$_SESSION["Marks"] = $_POST["Marks"];
$_SESSION["Image"] = $image_info[0];
if ($good == 1) {
    header("Location:pdf.php");
}
?>

<body>

    <div class="container">
        <?php include '../header.php'; ?>
        <form action="index.php" method="POST" enctype="multipart/form-data">

            <input type="text" onkeydown="return /[a-z]/i.test(event.key)" placeholder="First Name" id="first-name"
                class="txt txt1" name="fname" value="<?php echo $temp[0]; ?>" required>
            <span class="error">
                <?php echo $temp[2]; ?>
            </span>
            <br> <br>
            <input type="text" onkeydown="return /[a-z]/i.test(event.key)" placeholder="Last Name" id="last-name"
                class="txt txt2" name="lname" value="<?php echo $temp[1]; ?>" required>
            <span class="error">
                <?php echo $temp[3]; ?>
            </span>
            <br> <br>

            <div class="para">
                <span class="full-name"></span>
            </div>
            <br>
            <textarea name="Marks" cols="30" rows="10" id="txt-area" required></textarea><br><br>
            <input type="tel" name="mobile" placeholder="Enter Phone Number" required> <span class="error">
                <?php echo $temp2[1] ?>
            </span>
            <br><br>
            <input type="text" name="mail" placeholder="Enter Email" required> <span class="error">
                <?php echo $temp3[1]; ?>
            </span><br><br>
            Select image :
            <input type="file" name="image"><br><span class="error">
        <?php echo $image_info[1]; ?></span><br>
            <input type="submit" name="Submit">
            <br><br>

        </form>
        <div class="img-container">
        </div>

    </div>


</body>


<script>
    var space = " ";
    $(document).ready(function () {

        $(".txt").keyup(function () {
            $(".full-name").text($(".txt1").val() + space + $(".txt2").val());
        });


        $(".txt").keypress(function () {
            $(".error").hide();
        });

    });
</script>


</html>