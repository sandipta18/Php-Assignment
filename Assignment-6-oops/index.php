<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
require('action.php');

?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 6 oops</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>





<!-- body section -->

<body>

  <div class="container">
  <?php include '../header.php'; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
    <!-- Taking input as first name from user -->
      <input type="text"  placeholder="First Name" id="first-name" class="txt txt1" name="fname" required>
      <span class="error">
        <!-- Displaying errors if any -->
      <?php echo $temp[2]; ?>
      </span>
      <br> <br>
      <!-- Taking input as Surname from user -->
      <input type="text" placeholder="Last Name" id="last-name" class="txt txt2" name="lname" required>
      <span class="error">
        <!-- Displaying errors if any -->
      <?php echo $temp[3]; ?>
      </span>
      <br> <br>
      <input type="tel" name="mobile" placeholder="Enter Phone Number" class="phone" required>
      <span class="error">
        <!-- Displaying errors if any -->
        <?php echo $temp2[1]; ?>
      </span>
      <br> <br>
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
      <textarea name="Marks"cols="30" rows="10" id="txt-area" required> </textarea><br><br>
      Select image :
      <!-- Taking input as image from user -->
      <input type="file" name="image" required><br><span class="error"><?php echo $image_info[1]; ?></span><br>
      <input type="submit" name="submit">
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