<!-- This is basically the login page -->
<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 7</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php

  //This is checking whether the username and passowrd is empty or not
  //and will check if the username and passowrd is correct or not

  class Login
  {

    function validate_login()
    {
      $servername = 'localhost';
      $username = 'sandipta';
      $password = '182001@Mimo';
      $database = 'Assignment_7';
      $link = mysqli_connect($servername, $username, $password, $database);
      if (!$link) {
        die( mysqli_connect_error());
      }
      
      global $errorname;
      global $errorpassword;
      global $user_name;
      global $password;
      $errorname = "";
      $errorpassword = "";
      $user_name = $_POST["Name"];
      $password = $_POST["Password"];
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //If name is empty throw error
        if (empty($_POST["Name"])) {
          $errorname = "Please Enter Name";
        }
        //IF password is empty throw error
        if (empty($_POST["Password"])) {
          $errorpassword = "Please Enter Password";
        }
        $query = "select * from Signup where UserName = '$user_name' and Pass_word = '$password'";
        $result = mysqli_query($link,$query);
        $count = mysqli_num_rows($result);
        if($count>0){
          $_SESSION['name'] = ucwords(strtolower($_POST['Name']));
          header("Location:action.php");
        }
        else{
          $errorname = "Enter User Name Correctly";
          $errorname = "Enter User Name Correctly";
        }
      }
      $output = array($user_name, $password, $errorname, $errorpassword);
      return $output;
    }
  }
  ?>
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
        <input type="password" placeholder="Password" name="Password" class="box" required><span class="error">
          <?php echo $temp[3]; ?>
        </span><br>
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