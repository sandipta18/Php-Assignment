<?php 
session_start();
require '../class.php';

?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style2.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>SignUp Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="signup.php" method="post">
					<input class="text" type="text" name="username" placeholder="Username" required="">
					<input class="text email" type="email" name="mail" placeholder="Email" required="">
					<input class="text w3lpass" type="password" name="password" placeholder="Password" required="">
					<span>
						<?php  
						echo $error;
						?>
					</span>
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="SIGNUP" name="submit">
					<a href="index.php" >Go back</a>
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
<?php 
global $error;

	if(isset($_POST['submit'])){
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['email'] = $_POST['mail'];
        $_SESSION['password'] = $_POST['password'];
		if($_SESSION['checker']==1){
			$error = "Alredy Exists";
			
		}
		header('location:signupdb.php');
		
		
		
	}

?>
