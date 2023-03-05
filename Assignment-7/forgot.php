<!-- This is forgot password page -->
<!-- If facilitated user will be redirected to otp.php page -->
<?php
session_start();
include 'loadin.php';
include 'background.html';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="Enter your description here" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style4.css">
  <title>Forgot Password</title>
</head>

<body>

  <div class="form-gap"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Forgot Password?</h2>
              <p>You can reset your password here.</p>
              <div class="panel-body">
                <form id="register-form" autocomplete="off" class="form" method="post" action="otp.php">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                      <input id="email" name="mail" placeholder="email address" class="form-control" type="mail" required><br>
                    </div>
                  </div>
                  <div class="form-group">
                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                  </div>
                  <div class="form-group">
                    <button name="recover-submit" class="btn btn-lg btn-primary btn-block"><a href="index.php">Go Back</a></button>
                  </div>
                  <input type="hidden" class="hide" name="token" id="token" value="">
                  <span class="error">
                    <?php

                    if ($_SESSION['invalidemail'] === TRUE) {
                      echo $_SESSION['mess'];
                      $_SESSION['mess'] = "";
                      session_unset($_SESSION['invalidemail']);
                    } elseif ($_SESSION['exists'] == FALSE) {

                      echo $_SESSION['account'];
                      $_SESSION['account'] = "";
                      session_unset($_SESSION['exists']);
                    }
                    ?>
                  </span>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
