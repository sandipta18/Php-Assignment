<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 6</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>



<?php


$good = 0;
$errname = "";
$errsurname = "";
$name = "";
$surname = "";
$temp;
$number_validated = "";
$email_validated = "";
$photo = "";
$em = "";
$email_validated="";
$image_upload;
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
}




$imagename = $_FILES['image']['name'];
$imagepath = $_FILES['image']['full_path'];

$tempname = $_FILES['image']['tmp_name'];
$imagesize = $_FILES['image']['size'];
$errimage = "";
function validate_image($imagename, $tempname)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $good;
    global $imagesize;
    global $imagetype;
    global $errimage;
    global $tempname;
    global $imagename;
     // $uploadOk = 1;
    if(!$imagename){
        $errimage =  "Enter an image to proceed";
        $good = 0;
    }
    else if($imagesize>6000000){
        $errimage =  "Enter image less than 6MB";
        $good = 0;
    }

    elseif($imagename!=0) {
        $good = 1;
        $path = "images/" . $imagename;
        move_uploaded_file($tempname, $path);
        $_SESSION['uploadedImage'] = $path;


    }
}

}

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
}


function validate_email(){
    global $erremail;
    global $email_validated;
    global $em;
    global $good;
    $curl = curl_init();
    $em = $_POST["mail"];
    curl_setopt_array($curl, array(

    CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=".$em,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: text/plain",
        "apikey: 6lqXAXAXlgwac06C28c0iHsgZn47lrCy"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    $validationResult = json_decode($response, true);
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["mail"])){
        $erremail = "Enter Email";
        $good = 0;
    }
    if (!$validationResult['format_valid'] && !$validationResult['smtp_check']) {
        $erremail = "Enter email in proper format";
        $good = 0;
    }
    if ($validationResult['format_valid'] && $validationResult['smtp_check']) {
        $email_validated = $em;
        $good = 1;
    }
    curl_close($curl);
}
}





validate_phone();
validate_input();
validate_image($imagename, $tempname);
validate_email();

?>



<body>

    <div class="container">
        <form action="index.php" method="POST" enctype="multipart/form-data">

            <input type="text" onkeydown="return /[a-z]/i.test(event.key)" placeholder="First Name" id="first-name" class="txt txt1" name="fname" value="<?php echo $name; ?>" required>
            <span class="error"><?php echo $errname; ?></span>
            <br> <br>
            <input type="text" onkeydown="return /[a-z]/i.test(event.key)" placeholder="Last Name" id="last-name" class="txt txt2" name="lname" value="<?php echo $surname; ?>" required>
            <span class="error"><?php echo $errsurname; ?></span>
            <br> <br>

            <div class="para">
                <span class="full-name"></span>
            </div>
            <br>
            <textarea name="Marks" cols="30" rows="10" id="txt-area" ></textarea><br><br>
            <input type="tel" name="mobile" placeholder="Enter Phone Number" > <span class="error"><?php echo $errphone; ?></span>
            <br><br>
            <input type="text" name="mail" placeholder="Enter Email" > <span class="error" ><?php echo $erremail; ?></span><br><br>
            Select image :
            <input type="file" name="image"><br><span class="error"><?php echo $errimage; ?></span><br><br>
            <input type="submit" name="Submit">
            <br><br>

        </form>
        <div class="img-container">

        </div>

    </div>


</body>


<script>
    var space = " ";
    $(document).ready(function() {

        $(".txt").keyup(function() {
            $(".full-name").text($(".txt1").val() + space + $(".txt2").val());
        });


        $(".txt").keypress(function() {
            $(".error").hide();
        });

    });
</script>
<?php
$_SESSION["fname"] = $name;
$_SESSION["lname"] = $surname;
$_SESSION["mobile"] = $number_validated;
$_SESSION["mail"] = $email_validated;
$_SESSION["Marks"] = $_POST["Marks"];

if ($good == 1) {
    header("Location:pdf.php");
}
?>

</html>