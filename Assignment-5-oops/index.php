<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 5 oops</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <style>
    textarea{
      background-color: white;
    }

  </style>
</head>



<?php


class Name
{
/**
      * Summary of validate
      *This class has a public function named validate, it will be used to validate the input taken from the user and display errors
      *if required
      *@var string $name
      *@var string $surname
      *@var string $errorname
      *@var string $errorsurname
      *@param array $arr
      * @return array
 */


  public function validate()
  {
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
        if (!preg_match("/[a-zA-Z-' ]*$/", $tempname)) {
          $errorname = " * Only letters and white space allowed";
        } else {
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
        }
      }
    }
    $arr = array($name, $surname, $errorname, $errorsurname); //storing the data in an array that can be used to display
    //name/surname or errorname/error surname
    return $arr;
  }
}
?>
<!-- This function will be used to validate the image taken as input from the user -->
<?php
class Image{
function validate_image()
{
   /**
 * Summary of validate_image
 * @var string $target_dir
 * @var string $target_file
 * @var string $imageFileType
 * @var int $uploadOK
 * @return void
 */
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $uploadOk = 1;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $filepath = "images/" . $_FILES["file"]["name"];
    // If file path is empty then no image was uploade so displaying error
    if (empty($target_file)) {
      echo "No file was uploaded";
      $uploadOk = 0;
    }
    // If image already existed, displaying error
    elseif (file_exists($target_file)) {
      echo "File already exists.";
      $uploadOk = 0;
    }
    // If image type does not belong to any of the options mentioned below, displaying error
     elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo "Only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    // If file size is greater than 6MB, displaying error

     elseif ($_FILES["file"]["size"] > 600000) {
      echo "Use an image less than 6MB";
      $uploadOk = 0;
    }

    //If everything is succesfull, displaying the image
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $filepath) && $uploadOk != 0) {
      echo "<img src=" . $filepath . " height=450 width=500 />";
    }

  }
}
}

?>

<?php
class Table{
  /**
 * Summary of validate_table
 * This function will validate the input from text area
 * Accepted format of input : Subject|Marks
 * @var mixed $temp
 * @var mixed $line
 * @param array $marks
 * @return array
 */
public function validate_table()
{
  global $marks;
  if (isset($_POST["Marks"])) {
  // Segregating the entire input on the basis on line break
    $temp = explode("\n", $_POST["Marks"]);
    $marks = array();
    foreach ($temp as $value) {
       // Again segregating the input on the basis of  symbol "|"
      $line = explode("|", $value);
      if ($line[0] != "" && $line[1] != "") {
        //If input is not empty proceed
        if (($line[1] > 100) || (!is_numeric($line[1]))) {
          //Validaing accepted format
          $line[1] = "Incorrect input";
        } elseif (is_numeric($line[0])) {
          $line[0] = "Incorrect Input";
        }
        //If validation is succesfull store the output inside an associative array like (array['Subject']=Marks)
        $marks[$line[0]] = $line[1];
      }
    }
  }
  return $marks;
}
}
?>
<?php
class Phone{
  //This function will be use to validate phone number input taken from user
/**
 * Summary of validate_phone
 * Accepted format is +91{Number}
 * @var int$number_validated;
 * @var string $errphone
 * @param array $number_array
 * @return array
 */
function validate_phone()
{
  global $number_validated;
  global $errphone;
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
  $number_array = array($number_validated,$errphone);
  return $number_array;
}
}
?>
<?php
class Email{
/**
 * Summary of validate_email
 * @var string $erremail
 * @var string $email_validated
 * @param array $email
 * @return array
 */
public function validate_email()
{
  global $erremail;
  global $email_validated;
  $curl = curl_init();
  $em = $_POST["mail"];
  curl_setopt_array($curl, array(

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
    if ($validationResult['format_valid'] && $validationResult['smtp_check']) {
      $email_validated = $em;
    } else {
      $erremail = " Enter email in proper format";
    }
    curl_close($curl);
  }
  $email = array($email_validated,$erremail);
  return $email;
}
}
?>
<?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Created an object to call the function inside the class for validation
    $obj = new Name();
    $temp = $obj->validate();
  }

?>
<?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Created an object to call the function inside the class for validation
    $obj2 = new Image();

  }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {      //Created an object to call the function inside the class for validation
    $obj3 = new Table();
    $marks = $obj3->validate_table();
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {      //Created an object to call the function inside the class for validation
  $obj4 = new Phone();
  $temp2 = $obj4->validate_phone();
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST"){       //Created an object to call the function inside the class for validation
  $obj5 = new Email();
  $temp3 = $obj5->validate_email();
}
?>
<!-- body section -->

<body>

  <div class="container">
  <?php include '../header.php'; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
    <!-- Taking input as first name from user -->
      <input type="text" placeholder="First Name" id="first-name" class="txt txt1" name="fname"
        value="<?php echo $temp[0]; ?>" required>
        <!-- Displaying error if any -->
      <span class="error">
      <?php echo $temp[2]; ?>
      </span>
      <br> <br>
      <!-- Taking input as surname from user -->
      <input type="text" placeholder="Last Name" id="last-name" class="txt txt2" name="lname"
        value="<?php echo $temp[1]; ?>" required>
        <!-- Displaying error if any -->
      <span class="error">
      <?php echo $temp[3]; ?>
      </span>
      <br> <br>
      <!-- Taking input as phone number from the user -->
      <input type="tel" name="mobile" placeholder="Enter Phone Number" required class="phone">
      <span class="error">
        <!-- Displaying errors if any -->
        <?php echo $temp2[1]; ?>
      </span>
      <br><br>
      <!-- Taking input as email from the user -->
      <input type="text" name="mail" placeholder="Enter Email" required>
      <span class="error">
        <!-- Displaying errors if any -->
        <?php echo $temp3[1]; ?>
      </span><br><br>
      <!-- Live Displaying combination of first name and last name -->
      <div class="para">
        <span class="full-name"></span>
      </div>
      <br><br>
      <!-- Taking Marks input from user -->
      <textarea name="Marks" cols="30" rows="10" id="txt-area" required> </textarea><br><br>
      Select image :
      <!-- Taking input as image from user -->
      <input type="file" name="file" required><br>
      <input type="submit" name="Submit">
      <br><br>
      <?php
      if ($_SERVER['REQUEST_METHOD'] == "POST")  {            //displaying the output
        echo "Hello " . ucwords(strtolower($temp[0])) . " " . ucwords(strtolower($temp[1]))."<br>";
        echo "Phone Number is " . $temp2[0]."<br>";
        echo "Email is ".$temp3[0];
      }
      ?>
    </form>
    <div class="img-container">
      <?php
       if ($_SERVER['REQUEST_METHOD'] == "POST")  {            //displaying the output
        $obj2->validate_image();
      }
      ?>

    </div>

  </div>


</body>
<!-- This will be used to print the  input from text area in form of a table -->
  <?php
if (isset($_POST["Submit"])){?>
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

    $("#first-name").keydown(function () {
      return /[a-z]/i.test(event.key);
    });
    $("#last-name").keydown(function () {
      return /[a-z]/i.test(event.key);
    });
  });
</script>


</html>