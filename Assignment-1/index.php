 <?php 
require '../Assignment-7/loadin.php';
session_start();
if($_SESSION['set']==FALSE){
  header('location: ../Assignment-7/index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 1</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <?php
  //This will keep the session active
   //This will come handy when the user have entered the wrong form data
  //and while re entering the data in form user doesn't have to start from scratch.

  $errorname = "";
  $errorsurname = "";
  $name = "";
  $surname = "";
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
  function validate()
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
  }
  validate();
  ?>

  <!-- Content Section -->
  <div class="container">
    <?php require '../header.php'; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <!-- Input of First Name -->
      <input type="text" placeholder="First Name" id="first-name" class="txt txt1" name="fname"
        value="<?php echo $name; ?>" required>
      <span class="error">
        <!-- displaying error if any -->
        <?php echo $errorname; ?>
      </span>
      <br> <br>
      <!-- Input of Last Name -->
      <input type="text" placeholder="Last Name" id="last-name" class="txt txt2" name="lname"
        value="<?php echo $surname; ?>" required>
      <span class="error">
        <!-- displaying error if any -->
        <?php echo $errorsurname; ?>
      </span>
      <br> <br>
      <!-- live displaying input of first name and last name combined -->
      <div class="para">
        <span class="full-name"></span>
      </div>

      <br> <br>
      <input type="submit" class="submit">
      <br><br>
      <!-- Displaying name and first name -->
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Hello " .ucwords(strtolower($name))." ".ucwords(strtolower($surname));
      }
      ?>

    </form>

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

    $("#first-name").keydown(function () {
      return /[a-z]/i.test(event.key);
    });
    $("#last-name").keydown(function () {
      return /[a-z]/i.test(event.key);
    });


  });
</script>


</html>