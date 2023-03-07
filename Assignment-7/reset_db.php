<?php

session_start();
//facilitates validation
require 'class.php';
//facilitates login
include 'loginclass.php';
//facilitates checking whether account exists or not
include 'class accountexists.php';

$obj = new Validate();
require 'databaseinfo.php';
$_SESSION['confirm_fail'] = false;
$_SESSION['confirm_fail_message'] = "";
$_SESSION['password_validate'] = true;
$_SESSION['password_changed'] = false;
$_SESSION['pass_change_fail'] = "";
$_SESSION['password_change_success'] = "";
$good = 1;

// establishing connection 
$link = mysqli_connect($servername, $username, $password, $database);

// if connection failed killing the process
if (!$link) {
  die(mysqli_connect_error());
}

//if password validation failed revert back to reset password page
if ($obj->validate_password($_POST['password']) == FALSE) {
  $good = 0;
  $_SESSION['password_validate'] = false;
  $_SESSION['pass_change_fail'] = 'Enter 1 Special,Uppercase,Lowercase and Numeric character to proceed';
  header('location: reset.php');
}

elseif($_POST['password'] != $_POST['confirmPassword']){
  $good = 0;
  $_SESSION['confirm_fail'] = true;
  $_SESSION['confirm_fail_message'] = "Password Do Not Match";
  header('location:reset.php');
}

//encrypting the password using md5 function
$new_password = md5($_POST['password']);

//Implementing a query to retrieve the email and check it inside the database
$mail = $_SESSION['email'];
$sql = "select * from Signup where Email = '$mail' ";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) != 1) {
  $good = 0;
}

elseif (mysqli_num_rows($result) === 1 && $good == 1) {
  $sql_2 = "UPDATE Signup
                  SET Pass_word = '$new_password'
                  WHERE Email = '$mail' ";
  mysqli_query($link, $sql_2);
  $_SESSION['password_changed'] = true;
  $_SESSION['password_change_success'] = "Password Updated";
  header('location:index.php');
}

?>