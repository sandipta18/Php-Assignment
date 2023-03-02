<?php session_start(); ?>
<div class="btnGroup">
        <span class="Btn" id="verifiBtn">
          
        </span>
        <span class="timer">
          <span id="counter"></span>
        </span>
</div>
<script>
    function countdown() {
        var seconds = 59;
        function tick() {
          var counter = document.getElementById("counter");
          seconds--;
          counter.innerHTML =
            "0:" + (seconds < 10 ? "0" : "") + String(seconds);
          if (seconds > 0) {
            setTimeout(tick, 1000);
          }
           else {
            window.location.href = 'forgot.php';
            
          }
        }
        tick();
      }
      countdown();
</script>