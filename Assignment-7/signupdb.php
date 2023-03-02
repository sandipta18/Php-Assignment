<?php  
session_start();

require 'databaseinfo.php';

$_SESSION['account'] = false;
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
    if($count>0){
      $_SESSION['account'] = true;
      header('location:signup.php');
      
    }
    
    $sql = "INSERT INTO Signup (Username,Email,Pass_word)
    VALUES( '$name','$email','$password')";

    $result = mysqli_query($link,$sql);
    
    if($result){
      $_SESSION['account'] = true;
      header('location:index.php');
    }
    
  
?>