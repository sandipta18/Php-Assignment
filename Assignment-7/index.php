<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php


  $errorname = "";
  $errorpassword = "";
  $user_name = $_POST["Name"];
  $password = $_POST["Password"];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["Name"];
    $pass = $_POST["Password"];
    if (empty($_POST["Name"])) {
      $errorname = "Please Enter Name";
    }
    if (empty($_POST["Password"])) {
      $errorpassword = "Please Enter Password";
    }

    if ($user_name != "sandipta") {
      $errorname = "Enter User Name Correctly";
    }
    if ($password != "innoraft") {
      $errorpassword = "Enter Password Correctly";
    }
    if ($user_name === "sandipta18" && $password === "admin") {
      $_SESSION['name'] = $_POST['Name'];
      header("Location:action.php");
    }

  }
  ?>
  <div class="container flex-wrapper">
    <div class="form-section flex-wrapper -vertical">
      <form action="index.php" class="flex-wrapper -vertical" method="POST">
        <input type="text" placeholder="User Name" name="Name" class="box" required> <span class="error">
          <?php echo $errorname; ?>
        </span><br>
        <input type="password" placeholder="Password" name="Password" class="box" required><span class="error">
          <?php echo $errorpassword; ?>
        </span><br>
        <input type="submit" placeholder="Login" class="box-submit" name="submit">
      </form>
    </div>
  </div>
</body>

</html>