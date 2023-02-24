
<!DOCTYPE html>
<html lang="en">
<?php
require('action.php');
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 4 oops</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>





<!-- body section -->

<body>

  <div class="container">
  <?php include '../header.php'; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
    <!-- Taking input as first name from user -->
      <input type="text" placeholder="First Name" id="first-name" class="txt txt1" name="fname" required>
      <span class="error">
        <!-- Displaying errors if any -->
      <?php echo $temp[2]; ?>
      </span>
      <br> <br>
      <!-- Taking input as Surname from user -->
      <input type="text" placeholder="Last Name" id="last-name" class="txt txt2" name="lname" required>
      <span class="error">
        <!-- Displaying errors if any -->
      <?php echo $temp[3]; ?>
      </span>
      <br> <br>
      <input type="tel" name="mobile" placeholder="Enter Phone Number" required class="phone">
      <span class="error">
        <!-- Displaying errors if any -->
        <?php echo $temp2[1]; ?>
      </span>
      <br> <br>
      <!-- Live Displaying combination of first name and last name -->
      <div class="para">
        <span class="full-name"></span>
      </div>
      <br><br>
      <textarea name="Marks" cols="30" rows="10" id="txt-area" required="required"> </textarea><br><br>
      Select image :
      <!-- Taking input as image from user -->
      <input type="file" name="image" required><br><span class="error"><?php echo $temp1[1]; ?></span><br>
      <input type="submit" name="submit">
      <br><br>
      <?php
      if ($_SERVER['REQUEST_METHOD'] == "POST")  {
        if (isset($_POST['submit']) && $good==1) {
          //displaying the output
          echo "Hello " . ucwords(strtolower($temp[0])) . " " . ucwords(strtolower($temp[1]))."<br>";
          // echo "Phone Number is" . $temp2[0];
          echo "Phone Number is " . $temp2[0];
        }
      }
      ?>
    </form>
    <div class="img-container">
      <?php
       if ($_SERVER['REQUEST_METHOD'] == "POST")  {
        if (isset($_POST['submit']) && $good==1) {
          //displaying the output
          echo "<img src=" . $temp1[0] . " height=450 width=500 />";
        }
      }
      ?>

    </div>

  </div>


</body>
<?php
// displaying input from text area
if (isset($_POST["submit"]) && $good==1){?>
<table>
  <tr>
    <th>Subject</th>
    <th>Marks</th>
  </tr>

<?php } ?>
  <?php
  foreach ($marks as $key => $output) { ?>
    <tr>
      <td>
        <?php echo $key; ?>
      <td>
        <?php echo $output; ?>
    </tr>
  <?php } ?>
</table>

<!-- used jquery to facilitate the following things -->
<!-- User won't ba able to enter numeric value in the name field -->
<!-- Enabled the live capturing of first name and last name and displayed them as full name -->
<!-- If user have enterd wrong information and en error is being displayed, upon clicking the input field -->
<!-- the error will disappear -->
<script>
  var space = " ";
  $(document).ready(function () {

    $(".txt").keyup(function () {
      $(".full-name").text($(".txt1").val() + space + $(".txt2").val());
    });


    $(".txt").keypress(function () {
      $(".error").hide();
    });

    $("#first-name").keydown(function () {
      return /[a-z]/i.test(event.key);
    });
    $("#last-name").keydown(function () {
      return /[a-z]/i.test(event.key);
    });
  });
</script>


</html>