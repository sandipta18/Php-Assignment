<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment-1-oops</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
  //This class has a public function named validate, it will be used to validate the input taken from the user and display errors 
  //if required
  class Name
  {


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
      $arr = array($name, $surname, $errorname, $errorsurname);       //storing the data in an array that can be used to display
                                                                  //name/surname or errorname/error surname
      return $arr;
    }
  }
  ?>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Created an object to call the function inside it for validation
    $obj = new Name();
    $temp = $obj->validate();
  }

  ?>
  <!-- Content -->
  <div class="container">
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <input type="text" placeholder="First Name" id="first-name"
        class="txt txt1" name="fname" value="<?php echo $name; ?>">
      <span class="error">
        <?php echo $temp[2]; ?>
      </span>
      <br> <br>
      <input type="text"  placeholder="Last Name" id="last-name"
        class="txt txt2" name="lname" value="<?php echo $surname; ?>">
      <span class="error">
        <?php echo $temp[3]; ?>
      </span>
      <br> <br>

      <div class="para">
        <span class="full-name"></span>
      </div>

      <br> <br>
      <input type="submit" class="submit">
      <br><br>
      <?php
      if ($_SERVER['REQUEST_METHOD'] == "POST")              //displaying the output
        echo "Hello " . $temp[0] . " " . $temp[1];
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


    $("#first-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });
    $("#last-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });

  });
</script>

</html>
