<!-- This is basically the login page -->
<?php

session_start();
include 'class.php';
include 'loadin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 7</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <script src="script.js"></script>
</head>

<body>


  <?php
  
  $obj = new Login();
  $temp = $obj->validate_login();
  ?>
  <!-- content -->
  <div class="container flex-wrapper">
    <div class="form-section flex-wrapper -vertical">
      <form action="index.php" class="flex-wrapper -vertical" method="POST">
        <input type="text" placeholder="User Name" name="Name" class="box" required> <span class="error">
          <?php echo $temp[2]; ?>
        </span><br>
        <input type="password" placeholder="Password" name="Password" class="box" id ="hidden" required><span class="error">
          <?php echo $temp[3]; ?>
        </span><i class="fa-sharp fa-solid fa-eye show" onclick="show_pass()"></i>
        <input type="submit" value="Login" class="box-submit" name="submit">
      </form>
      <a href="signup.php" class="box-submit signup">Sign Up</a>
      <a href="forgot.php" class="box-submit signup">Forgot Password</a>
    </div>
  </div>
</body>
<!-- if forgot password option is clicked then it will redirect to an window where we can reset the password -->
<script>
  var space = " ";
  $(document).ready(function() {

    $(".fp").click(function() {
      <?php
      if (isset($_POST["forgot"])) {
        header("Location:forgot.php");
      }
      ?>
    });

    $(".signup").click(function() {

    })

  });
</script>

</html>
<?php 

if($_SESSION['account'] == true){
  echo "<script> alert ('Account Created'); </script>";
  session_unset($_SESSION['account']);
 }

elseif($_SESSION['password_changed'] == true){
 echo "<script> alert ('Password Changed'); </script>";
 session_unset($_SESSION['password_changed']);
}
?>