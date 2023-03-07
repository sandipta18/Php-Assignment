<?php  
session_start();

// Consists information about database.
require 'databaseinfo.php';

$_SESSION['account'] = false;
$_SESSION['account_created'] = "";
$_SESSION['account_exists'] = false;
$_SESSION['exists_error'] = "";

//establishing connection

$link = mysqli_connect($servername,$username,$password,$database); 

if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}
    
    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
    $password = md5($_SESSION['password']);
    $query = "select * from Signup where Email = '$email' ";
    $duplicate = mysqli_query($link,$query);
    $count = mysqli_num_rows($duplicate);
    //checking if account already exists, if yes then heading back to the signup page
    if ($count>0) {
      $_SESSION['account_exists'] = true;
      $_SESSION['exists_error'] = "Account already exists";
      header('location:signup.php');
    }
    
    //if account doesnot exists creating a new one

    else {

    $sql = "INSERT INTO Signup (Username,Email,Pass_word)
    VALUES( '$name','$email','$password')";

    $result = mysqli_query($link,$sql);
    
    if ($result) {
      $_SESSION['account'] = true;
      $_SESSION['account_created'] = "Account Created Succesfully";
      header('location:index.php');
    }
  }
  
?>