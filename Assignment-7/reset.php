<?php session_start();
include 'loadin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="script.js"></script>
  <title>Reset Password</title>
</head>

<body>
  <div class="mainDiv">
    <div class="cardStyle">
      <form action="reset_db.php" method="post" name="signupForm" id="signupForm">

        <img src="" id="signupLogo" />
        <h2 class="formTitle">
          Set New Password
        </h2>

        <div class="inputDiv">
          <label class="inputLabel" for="password">New Password</label>
          <input type="password" id="password" name="password"  required><i class="fa-sharp fa-solid fa-eye show" onclick="show_passed()"></i>
        </div>

        <div class="inputDiv">
          <label class="inputLabel" for="confirmPassword">Confirm Password</label>
          <input type="password" id="confirmPassword" name="confirmPassword">
        </div>

        <div class="buttonWrapper">
          <button type="submit" id="submitButton" onclick="validateSignupForm()" class="submitButton pure-button pure-button-primary" name="submit2">
            <span>Continue</span>
            <span id="loader"></span>
          </button>
        </div>
        <div class="anchor inputDiv">
        <a href="forgot.php" class="submitButton pure-button pure-button-primary">
          <span>Go back</span>
        </a>
        </div>

      </form>
    </div>
  </div>
</body>

</html>
<?php
if ($_SESSION['exist'] == false) {
  echo "<script> alert ('Account Doesn't Exists'); </script>";
}
if( $_SESSION['password_validate'] == false){
  echo "<script> alert ('Password Must Contain upper case,lowercase,special characters and numeric value'); </script>";
}
?>