<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 3 oops</title>
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

<?php
/**
 * Summary of Image
 * Class Image contans a functions named validate_image which will be used to validate the image taken as input from user
 */
class Image{
function validate_image()
{
  /**
 * Summary of validate_image
 * @var string $target_ir
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
    if (file_exists($target_file)) {
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
      //If input is not empty proceed
      if ($line[0] != "" && $line[1] != "") {
        //Validaing accepted format
        if (($line[1] > 100) || (!is_numeric($line[1]))) {
          $line[1] = "Incorrect input";
        }
         elseif (is_numeric($line[0])) {
          $line[0] = "Incorrect Input";
        }
        //If validation is succesfull store the output inside an associative array like (array['Subject']=Marks)
        $marks[$line[0]] = $line[1];
      }
    }
  }
  return $marks;  //return the array consisting of validated data
}
}
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Created an object to call the function(validate_name)inside it for validation
    $obj = new Name();
    $temp = $obj->validate();
  }

?>
<?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Created an object to call the function (validate_image)inside it for validation
    $obj2 = new Image();

  }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {       //Created an object to call the function (validate_table)inside it for validation
  $obj2 = new Image();
    $obj3 = new Table();
    $marks = $obj3->validate_table();
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
      <span class="error">
         <!-- Displaying error if any -->
      <?php echo $temp[2]; ?>
      </span>
      <br> <br>
      <!-- Taking input as Surname from user -->
      <input type="text" placeholder="Last Name" id="last-name" class="txt txt2" name="lname"
        value="<?php echo $temp[1]; ?>" required>
      <span class="error">
        <!-- Displaying error if any -->
      <?php echo $temp[3]; ?>
      </span>
      <br> <br>
      <!-- Live Displaying combination of first name and last name -->
      <div class="para">
        <span class="full-name"></span>
      </div>
      <br><br>
      <textarea name="Marks" cols="30" rows="10" id="txt-area" required> </textarea><br><br>
      Select image :
      <!-- Taking input as image from user -->
      <input type="file" name="file" required><br>
      <input type="submit" name="Submit">
      <br><br>
      <?php
      if ($_SERVER['REQUEST_METHOD'] == "POST")  {            //displaying the output
        echo "Hello " . ucwords(strtolower($temp[0])) . " " . ucwords(strtolower($temp[1]));
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
<!-- Printing the data from textarea in form of table -->
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
<?php
session_destroy();
?>

</html>