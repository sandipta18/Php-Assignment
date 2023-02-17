<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>

<title>Forgot Password</title>
</head>
<body>
<form action="forgot.php" method="POST">
<p>Password Recovery Window</p>
<input type="text" name="name" placeholder="Enter User Name"><br><br>
<input type="submit"><br><br>
<a href="index.php">Go back</a>
</form>

</body>
<?php
global $errorusername;
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_POST["name"];
if($username === "sandipta18"){
  echo "Your Password is : admin";

}
else{
  echo "Wrong Username";
}
}
?>
</html>
<?php

session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);

?>