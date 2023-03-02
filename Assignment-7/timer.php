<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style7.css">
  <title>Document</title>
</head>
<body>
<div class="btnGroup">
  <span class="Btn" id="verifiBtn">
  </span>
  <span class="timer">
    <span id="counter"></span>
  </span>
</div>
</body>
</html>



<script>
  function countdown() {
    var seconds = 1200;

    function tick() {
      var counter = document.getElementById("counter");
      seconds--;
      counter.innerHTML =
        "You will be redirected in " + "0:" + (seconds < 10 ? "0" : "") + String(seconds);
      if (seconds > 0) {
        setTimeout(tick, 1000);
      } else {
        window.location.href = 'forgot.php';

      }
    }
    tick();
  }
  countdown();
</script>