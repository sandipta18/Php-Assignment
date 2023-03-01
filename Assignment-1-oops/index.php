<?php
session_start();
if($_SESSION['set']==FALSE){
  header('location: ../Assignment-7/index.php');
}
require('action.php');
?>
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


  <!-- Content -->
  <div class="container">
  <?php include '../header.php'; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <!-- Taking First Name as input from user -->
      <input type="text" placeholder="First Name" id="first-name"
        class="txt txt1" name="fname" required>
      <span class="error">
        <!-- displaying errors if any -->
        <?php echo $temp[2]; ?>
      </span>
      <br> <br>
      <!-- Taking input as second name from user -->
      <input type="text"  placeholder="Last Name" id="last-name"
        class="txt txt2" name="lname" required>
      <span class="error">
        <!-- displaying errors if any -->
        <?php echo $temp[3]; ?>
      </span>
      <br> <br>

      <div class="para">
        <!-- live displaying first name and last name combined -->
        <span class="full-name"></span>
      </div>

      <br> <br>
      <input type="submit" class="submit" name="submit">
      <br><br>
      <?php
       //displaying the output
        if (isset($_POST['submit'])) {
          echo "Hello " . ucwords(strtolower($temp[0])) . " " . ucwords(strtolower($temp[1]));
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


    $("#first-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });
    $("#last-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });

  });
</script>

</html>