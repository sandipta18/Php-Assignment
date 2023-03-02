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
        var seconds = 120;
        function tick() {
          var counter = document.getElementById("counter");
          seconds--;
          counter.innerHTML =
            "0:" + (seconds < 10 ? "0" : "") + String(seconds);
          if (seconds > 0) {
            setTimeout(tick, 1000);
          }
           else {
            document.getElementById("verifiBtn").innerHTML = `
                <div class="Btn" id="ResendBtn">
                    <button type="submit">Resend OTP</button>
                    
                </div>
            `;
            document.getElementById("counter").innerHTML = "";
            document.getElementById('ResendBtn').onclick = function(){
                location.href="validate_otp.php";
            };
            
            
          }
        }
        tick();
      }
      countdown();
</script>