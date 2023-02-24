<?php 
require_once '../vendor/autoload.php';

use GuzzleHttp\Client;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 5</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>



<?php
                                 //This will keep the session active
session_start();                 //This will come handy when the user have entered the wrong form data
                                 //and while re entering the data in form user doesn't have to start from scratch.
$good = 0;
$errorname = "";
$errorsurname = "";
$name = "";
$surname = "";
$temp;

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
  global $errorname;
  global $errorsurname;
  global $name;
  global $surname;
  global $temp;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) {
      $errorname = " * Name is Required";
    } else {
      $tempname = ($_POST["fname"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $tempname)) {
        $errorname = " * Only letters and white space allowed";
      } else {
        $good = 1;
        $name = $tempname;
      }
    }

    if (empty($_POST["lname"])) {
      $errorsurname = " * Surname is Required";
    } else {
      $tempsurname = ($_POST["lname"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $tempsurname)) {
        $errorsurname = " * Only letters and white space allowed";
      } else {
        $surname = $tempsurname;
        $good = 1;
      }
    }
  }
}

//This function will be used for validating image input taken from user
/**
 * Summary of validate_image
 * @var string $target_dir
 * @var string $target_file
 * @var string $imageFileType
 * @var int $uploadOK
 * @return void
 */
function validate_image()
{
  global $good;
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $uploadOk = 1;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $filepath = "images/" . $_FILES["file"]["name"];
    // If file path is empty then no image was uploade so displaying error
    if (empty($target_file)) {
      echo "Enter an image";
      $good = 0;
    }
    // If image already existed, displaying error
    if (file_exists($target_file)) {
      echo "File already exists.";
      $good = 0;
    }
    // If image type does not belong to any of the options mentioned below, displaying error
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo "Only JPG, JPEG, PNG & GIF files are allowed.";
      $good = 0;
    }
    // If file size is greater than 6MB, displaying error
    if ($_FILES["file"]["size"] > 600000) {
      echo "Use an image less than 6MB";
      $good = 0;
    }

    //If everything is succesfull, displaying the image
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $filepath) && $uploadOk != 0) {
      $good = 1;
      echo "<img src=" . $filepath . " height=450 width=500 />";

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
  global $good;
  global $erremail;
  global $email_validated;
  $client = new Client([
      // Base URI is used with relative requests
      'base_uri' => 'https://api.apilayer.com'
  ]);
  $em = $_POST['mail'];
  $response = $client->request('GET', 'email_verification/check?email=' . $em, [
      'headers' => [
          'apikey' => 'EgFVIMYLC78KM6VD65HlOY6k5VpA0CTB',
      ]
  ]);

  $body = $response->getBody();
  $arr_body = json_decode($body);
  if($_SERVER['REQUEST_METHOD']=='POST'){
  if (empty($_POST['mail'])) {
      $erremail = "Enter Email";
      $good = 0;
  }
  if ($arr_body->format_valid && $arr_body->smtp_check) {
      $email_validated = $em;
      $good = 1;
  } else {
      $erremail = "Enter Email in valid format";
      $good = 0;
  }
}
}

//This function will be used to validate the text area input taken as input from the user
function validate_table()
{
  global $marks;
  if (isset($_POST["Marks"])) {
  // Segregating the entire input on the basis on line break
    $temp = explode("\n", $_POST['Marks']);
      $marks = array();
      $checker = array();
      foreach ($temp as $value) {
        // Again segregating the input on the basis of  symbol |
        $line = explode("|", $value);
        if ($line[0] != "" && $line[1] != "") {
          //If input is not empty
          if(in_array($line[0],$checker)){
          $line[0] = "duplicate input";
          }
          array_push($checker,$line[0]);
          if(($line[1] > 100) || (!is_numeric($line[1]))) {
            //Validaing accepted format
            $line[1] = "Incorrect input";
          }
          if (is_numeric($line[0])) {
            $line[0] = "Incorrect Input";
          }
          //If validation is succesfull store the output inside an associative array like (array['Subject']=Marks)
          $marks[$line[0]] = $line[1];
        }

    }

  }
}
validate_table();
validate_phone();
validate_input();
validate_email();

?>


<!-- Content -->
<body>

  <div class="container">
  <?php include '../header.php'; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
    <!-- Taking input as first name from user -->
      <input type="text" placeholder="First Name" id="first-name"
        class="txt txt1" name="fname" value="<?php echo $name; ?>" required>
      <span class="error">
        <!-- Displaying error if any -->
        <?php echo $errorname; ?>
      </span>
      <br> <br>
      <!-- Taking input as surname from user -->
      <input type="text" placeholder="Last Name" id="last-name"
        class="txt txt2" name="lname" value="<?php echo $surname; ?>" required>
      <span class="error">
        <!-- Displaying error if any -->
        <?php echo $errorsurname; ?>
      </span>
      <br> <br>
      <!-- Live Displaying combination of first name and last name -->
      <div class="para">
        <span class="full-name"></span>
      </div>
      <br>
      <!-- Taking Marks input from user -->
      <textarea name="Marks" cols="30" rows="10" id="txt-area" required="required"></textarea><br><br>
      <!-- Taking input as phone number from user -->
      <input type="tel" name="mobile" placeholder="Enter Phone Number" required> <span class="error">
        <?php echo $errphone ?>
      </span>
      <br><br>
      <!-- Taking input as email from the user -->
      <input type="text" name="mail" placeholder="Enter Email" required> <span class="error">
        <?php echo $erremail ?>
      </span><br><br>
      <!-- Taking input as image from user -->
      Select image :
      <input type="file" name="file" required><br>
      <input type="submit" name="Submit">
      <br><br>
      <?php
      if (isset($_POST["Submit"]) && $good == 1) {
        echo "Hello " .ucwords(strtolower($name))." ".ucwords(strtolower($surname))."<br>";
        echo "Phone Number is" . $number_validated."<br>";
        echo "Email ID is" . $email_validated;
      }
      ?>
    </form>
    <div class="img-container">
      <?php
      validate_image();
      ?>
    </div>

  </div>

<!-- Displaying the input from text area in form of table -->
</body>
<!-- This will be used to print the  input from text area in form of a table -->
<?php
if (isset($_POST["Submit"]) && $good == 1){?>
<table>
  <tr>
    <th>Subject</th>
    <th>Marks</th>
  </tr>

<?php } ?>

  <?php
  foreach ($marks as $key => $output) { ?>
    <tr>
      <td>
        <?php echo $key; ?>
      <td>
        <?php echo $output; ?>
    </tr>
  <?php } ?>
</table>


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
<?php
session_destroy();
?>

</html>