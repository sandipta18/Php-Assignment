<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'class.php';

$obj = new validate();
$servername = 'localhost';
$username = 'sandipta';
$password = '182001@Mimo';
$database = 'Assignment_7';
$_SESSION['exist'] = true;
$_SESSION['password_validate'] = true;
$_SESSION['password_changed'] = false;
$good = 1;
$link = mysqli_connect($servername,$username,$password,$database); 

if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}
   
    
    if($obj->validate_password($_POST['password'])== FALSE){
      $good = 0;
      $_SESSION['password_validate'] = false;
      header('location: reset.php');
      
    }
    $new_password = $_POST['password'];
    $mail = $_SESSION['email'];
    $sql = "select * from Signup where Email = '$mail' ";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result) != 1){
      $good = 0;
      $_SESSION['exist'] = false;
      header('location:reset.php');

  }
    elseif(mysqli_num_rows($result) === 1 && $good == 1){
        $sql_2 = "UPDATE Signup
                  SET Pass_word = '$new_password'
                  WHERE Email = '$mail' ";
        mysqli_query($link,$sql_2);
        $_SESSION['password_changed'] = true;
    header('location:index.php');
    }
?>