<?php 
session_start();
require 'class.php';
include 'loadin.php';
include 'signupvalidate.php';
include 'loginclass.php';
include 'class accountexists.php'
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<!-- Custom Theme files -->
<link href="css/style2.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
<script src="script.js"></script>
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>SignUp Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="signup.php" method="post">
					<input class="text txt" type="text" name="username" placeholder="Username" required="">
					<input class="text email txt" type="email" name="mail" placeholder="Email" required="">
					<input class="text w3lpass txt" type="password" name="password" placeholder="Password" id = "hidden" required="">
					<i class="fa-sharp fa-solid fa-eye show" onclick="show_pass()"></i>
					
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="SIGNUP" name="submit">
					<a href="index.php" >Go back</a>
					<div class = "error">
				       <?php
					   if(isset($error_password)){
					    echo $error_password;
						$error_password = "";
					   }
					   ?>
					   <?php
					   if(isset($error_email)){
						echo $error_email;
						$error_email = "";
					   }
					   ?>
					   <?php
					   if(isset($_SESSION['account_exists']))
					   if($_SESSION['account_exists']== true){
						echo $_SESSION['exists_error'];
						$_SESSION['exists_error'] = "";
						session_unset($_SESSION['account_exists']);
					   }
					   
						?>
					</div>
				</form>
				
			</div>
		</div>
		
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>



<script>
  $(document).ready(function() {
    $(".txt").keypress(function () {
      $(".error").hide();
    });

  });
</script>

