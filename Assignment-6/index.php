<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
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
$errname = "";
$errsurname = "";
$name = "";
$surname = "";
$temp;
$number_validated = "";
$email_validated = "";
$photo = "";
$em = "";
$email_validated = "";
$image_upload;
//this function will be used to validate input taken from user
function validate_input()
{
  /**
   * Summary of validate_input()
   * @var string $name
   * @var string $surname
   * @var string $errorname
   * @var string $errorsurname
   * This function will be used to validate the input taken from the user
   * Validation Properties are as follows:
   * Empty Name/Surname, User is allowed to only enter alphabet
   * @return void
*/
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
/**
 * Summary of validate_image
 * This function will be used to validate the image taken as input from the user
 * @param mixed $imagename
 * @param mixed $tempname
 * @return void
 */
function validate_image($imagename, $tempname)
{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $good;
    global $imagesize;
    global $imagetype;
    global $errimage;
    global $tempname;
    global $imagename;
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
      $_SESSION['uploadedImage'] = $path;


    }
  }

}
//This function will be used to validate phone number taken as input from user
/**
 * Summary of validate_phone
 * Accepted format is +91{Number}
 * @var $number_validated;
 * @var $errphone
 * @return void
 */
function validate_phone()
{
  global $number_validated;
  global $errphone;
  global $good;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["mobile"];
     //validating the accepted format
    if (preg_match("/^[+91]{3}[0-9]{10}$/", $number)) {
      $number_validated = $number;
      $good = 1;
    } else {
      $errphone = " Enter Number in valid format";
      $good = 0;
    }
  }
}

//This function will be used to validate email taken as input from user using mailbox layer api
/**
 * Summary of validate_email
 * @var string $erremail
 * @var string $email_validated
 * @var string $em
 * @return void
 */
function validate_email()
{
  global $erremail;
  global $email_validated;
  global $em;
  global $good;
  //Initializing curl session
  $curl = curl_init();
  $em = $_POST["mail"];
  curl_setopt_array($curl, array(

    CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $em,
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
  )
  );

  $response = curl_exec($curl);
  $validationResult = json_decode($response, true);
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //If no email is entered display error
    if (empty($_POST["mail"])) {
      $erremail = "Enter Email";
      $good = 0;
    }
    //If format of email is not valid display error
    if (!$validationResult['format_valid'] && !$validationResult['smtp_check']) {
      $erremail = "Enter email in proper format";
      $good = 0;
    }
    //If validation checks proceed
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
<!-- Setting all the session variables, and if everthing is good proceed to next page -->
<?php
$_SESSION["fname"] = ucwords(strtolower($name));
$_SESSION["lname"] = ucwords(strtolower($surname));
$_SESSION["mobile"] = $number_validated;
$_SESSION["mail"] = $email_validated;
$_SESSION["Marks"] = $_POST["Marks"];

if ($good == 1) {
  header("Location:pdf.php");
}
?>


<body>

  <div class="container">
  <?php include '../header.php'; ?>
    <form action="index.php" method="POST" enctype="multipart/form-data">
     <!-- Taking input as first name from user -->
      <input type="text" placeholder="First Name" id="first-name"
        class="txt txt1" name="fname" value="<?php echo $name; ?>" required>
        <!-- Displaying errors if any -->
      <span class="error">
        <?php echo $errname; ?>
      </span>
      <br> <br>
      <!-- Taking input as surame from user -->
      <input type="text" placeholder="Last Name" id="last-name"
        class="txt txt2" name="lname" value="<?php echo $surname; ?>" required>
        <!-- Displaying error if any -->
      <span class="error">
        <?php echo $errsurname; ?>
      </span>
      <br> <br>
      <!-- Live Displaying full name -->
      <div class="para">
        <span class="full-name"></span>
      </div>
      <br>
      <!-- Taking input as Marks from user -->
      <textarea name="Marks" cols="30" rows="10" id="txt-area"></textarea><br><br>
      <input type="tel" name="mobile" placeholder="Enter Phone Number"> <span class="error">
        <!-- Displaying error if any -->
        <?php echo $errphone; ?>
      </span>
      <br><br>
      <!-- Taking input as email from the user -->
      <input type="text" name="mail" placeholder="Enter Email"> <span class="error">
        <!-- Displaying error if any -->
        <?php echo $erremail; ?>
      </span><br><br>
      Select image :
      <!-- Taking input as image from user -->
      <input type="file" name="image"><br><span class="error">
        <?php echo $errimage; ?>
      </span><br><br>
      <input type="submit" name="Submit">
      <br><br>

    </form>
    <div class="img-container">

    </div>

  </div>


</body>
<!-- used jquery to facilitate the following things -->
<!-- User won't ba able to enter numeric value in the name field -->
<!-- Enabled the live capturing of first name and last name and displayed them as full name -->
<!-- If user have enterd wrong information and en error is being displayed, upon clicking the input field -->
<!-- the error will disappear -->

<script>
  var space = " ";
  $(document).ready(function () {

    $(".txt").keyup(function () {
      $(".full-name").text($(".txt1").val() + space + $(".txt2").val());
    });


    $(".txt").keypress(function () {
      $(".error").hide();
    });

    $("#first-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });
    $("#last-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });

  });
</script>


</html>