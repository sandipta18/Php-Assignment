<?php  
session_start();

$servername = 'localhost';
$username = 'sandipta';
$password = '182001@Mimo';
$database = 'Assignment_7';
$_SESSION['account'] = false;
$link = mysqli_connect($servername,$username,$password,$database); 

if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}
    
    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];

    $query = "select * from Signup where Email = '$email' ";
    $duplicate = mysqli_query($link,$query);
    $count = mysqli_num_rows($duplicate);
    
    if($count>0){
      $_SESSION['checker'] = 1;
      header('location:signup.php');
      
    }
    
    $sql = "INSERT INTO Signup (Username,Email,Pass_word)
    VALUES( '$name','$email','$password')";

    $result = mysqli_query($link,$sql);
    
    if($result){
      // echo "<script> alert ('Account Created'); </script>";
      $_SESSION['account'] = true;
      header('location:index.php');
    }
    
  
?>