<?php

session_start();
if($_SESSION['set']==FALSE){
  header('location: ../Assignment-7/index.php');
}
?>
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment-1-session</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php


  $errorname = "";
  $errorsurname = "";
  $name = "";
  $surname = "";
  $temp;
  $good = 0;
  $firstname = "";
  function validate()
  {
    global $errorname;
    global $errorsurname;
    global $name;
    global $surname;
    global $good;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["fname"])) {
        $errorname = " * Name is Required";
        $good = 0;
      } else {
        $tempname = ($_POST["fname"]);
        if (!preg_match("/[a-zA-Z-' ]*$/", $tempname)) {
          $errorname = " * Only letters and white space allowed";
          $good = 0;
        } else {
          $name = $tempname;
          $good = 1;
          $_SESSION['firstname'] = ucwords(strtolower($name));

        }
      }

      if (empty($_POST["lname"])) {
        $errorsurname = " * Surname is Required";
        $good = 0;
      } else {
        $tempsurname = ($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $tempsurname)) {
          $errorsurname = " * Only letters and white space allowed";
          $good = 0;
        } else {
          $surname = $tempsurname;
          $good = 1;
          $_SESSION['surname'] = ucwords(strtolower($surname));
        }
      }


    }
  }
  validate();
  ?>
  <?php
  if ($good == 1) {
   header('Location: action.php');
   exit;
  }

  ?>
  <div class="container">
  <?php include('../header.php'); ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
      <input type="text" placeholder="First Name" id="first-name" class="txt txt1" name="fname" required
        value="<?php echo $name; ?>">
      <span class="error">
        <?php echo $errorname; ?>
      </span>
      <br> <br>
      <input type="text" placeholder="Last Name" id="last-name" class="txt txt2" name="lname" required
        value="<?php echo $surname; ?>">
      <span class="error">
        <?php echo $errorsurname; ?>
      </span>
      <br> <br>

      <div class="para">
        <span class="full-name"></span>
      </div>

      <br> <br>
      <input type="submit" class="submit">
      <br><br>



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