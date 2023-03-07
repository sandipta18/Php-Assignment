<?php 

$error = "";
$error_password = "";
$error_email = "";
$error_account = "";
$good = 1;
if($_SERVER['REQUEST_METHOD']=='POST'){
if(isset($_POST['submit'])){
	$obj = new Validate();
	if($obj->validate_password($_POST['password'])){
	  $_SESSION['password'] = $_POST['password'];
	}
	else{
	   $error_password = "Enter Password in proper format";
	   $good = 0;
	}
	$_SESSION['username'] = $_POST['username'];
	if($obj->validate_email($_POST['mail'])){
		$_SESSION['email'] = $_POST['mail'];
	}
	else{
		$error_email = "Enter valid Email ID";
		$good = 0;
	}
	if($good == 1){
		header('location:signupdb.php');
	}	
}
}

?>
