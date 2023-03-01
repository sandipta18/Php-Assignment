<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$servername = 'localhost';
$username = 'sandipta';
$password = '182001@Mimo';
$database = 'Assignment_7';
$link = mysqli_connect($servername,$username,$password,$database); 

if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}



  if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $email = $_POST['mail'];
    $password = $_POST['password'];

    $query = "select * from Signup where Email = '$email' ";
    $duplicate = mysqli_query($link,$query);
    $count = mysqli_num_rows($duplicate);
    
    if($count>0){
      $_SESSION['checker'] = 1;
      // $_SESSION['error']='Error while signing up'; 
      header('location:signup.php');
    }
    
    $sql = "INSERT INTO Signup (Username,Email,Pass_word)
    VALUES( '$name','$email','$password')";

    $result = mysqli_query($link,$sql);
    
    if($result){
      header('location:index.php');
    }
    // else{
    //   $_SESSION['error']='Error while signing up'; 
    //   header('location:signup.php');
    // }
  }
