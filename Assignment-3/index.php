<?php 
include '../Assignment-7/loadin.php';
session_start();
if($_SESSION['set']==false){
  header('location: ../Assignment-7/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 3</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>



<?php
session_start();
$errorname = $errorsurname = "";
$name = $surname = "";
$temp;
/**
   * Summary of validate
   * @var string $name
   * @var string $surname
   * @var string $errorname
   * @var string $errorsurname
   * This function will be used to validate the input taken from the user
   * Validation Properties are as follows:
   * Empty Name/Surname, User is allowed to only enter alphabet
   * @return void
*/
function validate_input()
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
      if (!preg_match("/^[a-zA-Z-' ]*$/", $tempname)) {
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
}

 //This function will be used to validate the image taken as input from the user
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
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo "Only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    // If file size is greater than 6MB, displaying error
    if ($_FILES["file"]["size"] > 600000) {
      echo "Use an image less than 6MB";
      $uploadOk = 0;
    }

    //If everything is succesfull, displaying the image
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $filepath) && $uploadOk != 0) {
      echo "<img src=" . $filepath . " height=450 width=500 />";
    }
  }
}

function array_not_unique( $a = array() )
{
  return array_diff_key( $a , array_unique( $a ) );
}
/**
 * Summary of validate_table
 * This function will validate the input from text area
 * Accepted format of input : Subject|Marks
 * @var array $marks
 * @var array $temp
 * @var array $line
 * @return void
 */
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
validate_input();

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
      <!-- Taking input as Surname from user -->
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
      <br><br>
      <textarea name="Marks" cols="30" rows="10" id="txt-area" required="required"> </textarea><br>
      Select image :
      <!-- Taking input as image from user -->
      <input type="file" name="file" required><br>
      <input type="submit" name="Submit">
      <br><br>
      <?php
      if(isset($_POST["Submit"])){
        echo "Hello " .ucwords(strtolower($name))." ".ucwords(strtolower($surname));  //displaying output
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

    $("#first-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });
    $("#last-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });

  });
</script>


</html>