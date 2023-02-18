<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 4</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>



<?php
session_start();
$good = 0;
$errorname = $errorsurname = "";
$name = $surname = "";
$temp;

//This function will be used to validate text input taken from user
function validate_input()
{
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
function validate_image()
{
  global $good;
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $uploadOk = 1;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $filepath = "images/" . $_FILES["file"]["name"];
    if (empty($target_file)) {
      echo "Enter an image";
      $uploadOk = 0;
    }

    if (file_exists($target_file)) {
      echo "File already exists.";
      $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo "Only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    if ($_FILES["file"]["size"] > 600000) {
      echo "Use an image less than 6MB";
      $uploadOk = 0;
    }


    if (move_uploaded_file($_FILES["file"]["tmp_name"], $filepath) && $uploadOk != 0) {
      $good = 1;
      echo "<img src=" . $filepath . " height=450 width=500 />";

    }

  }
}
//This function will be use to validate phone number input taken from user
function validate_phone()
{
  global $number_validated;
  global $errphone;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["mobile"];
    if (preg_match("/^[+91]{3}[0-9]{10}$/", $number)) {
      $number_validated = $number;
      $good = 1;
    } else {
      $errphone = " Enter Number in valid format";
    }
  }
}
//This function will be used to validate text area input taken from user
function validate_table()
{
  global $marks;
  if (isset($_POST["Marks"])) {

    $temp = explode("\n", $_POST["Marks"]);
    $marks = array();
    foreach ($temp as $value) {
      $line = explode("|", $value);
      if ($line[0] != "") {
        if ($line[1] > 100) {
          $line[1] = "Incorrect input";
        }
        $marks[$line[0]] = $line[1];
      }
    }
  }
}
validate_table();
validate_phone();
validate_input();

?>


<!-- Content -->
<body>

  <div class="container">
  <?php include '../header.php'; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

      <input type="text" placeholder="First Name" id="first-name"
        class="txt txt1" name="fname" value="<?php echo $name; ?>" required>
      <span class="error">
        <?php echo $errorname; ?>
      </span>
      <br> <br>
      <input type="text" placeholder="Last Name" id="last-name"
        class="txt txt2" name="lname" value="<?php echo $surname; ?>" required>
      <span class="error">
        <?php echo $errorsurname; ?>
      </span>
      <br> <br>

      <div class="para">
        <span class="full-name"></span>
      </div>
      <br>
      <textarea name="Marks" cols="30" rows="10" id="txt-area" required></textarea><br><br>
      <input type="tel" name="mobile" placeholder="Enter Phone Number" required class="phone"><span class="error">
        <?php echo $errphone ?>
      </span>
      <br><br>
      Select image :
      <input type="file" name="file" required><br>
      <input type="submit" name="Submit">
      <br><br>
      <?php
      if (isset($_POST["Submit"]) && $good == 1) {
        echo "Hello {$name} {$surname} <br>";
        echo "Phone Number is" . $number_validated;
      }
      ?>
    </form>
    <div class="img-container">
      <?php
      validate_image();
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