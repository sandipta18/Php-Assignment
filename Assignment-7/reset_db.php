<?php 

session_start();

$servername = 'localhost';
$username = 'sandipta';
$password = '182001@Mimo';
$database = 'Assignment_7';
$link = mysqli_connect($servername,$username,$password,$database); 

if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}
    $mail = $_SESSION['email'];
    $new_password = $_POST['password'];
    $sql = "select * from Signup where Email = '$mail' ";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result) === 1){
        $sql_2 = "UPDATE Signup
                  SET Pass_word = '$new_password'
                  WHERE Email = '$mail' ";
        mysqli_query($link,$sql_2);
    header('location:index.php');
    }

?>