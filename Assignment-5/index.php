<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 2</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>



<?php
//This will keep the session active
session_start(); //This will come handy when the user have entered the wrong form data
//and while re entering the data in form user doesn't have to start from scratch.
$good = 0;
$errname = $errsurname = "";
$name = $surname = "";
$temp;
function validate_input()
{
  global $good;
  global $errname;
  global $errsurname;
  global $name;
  global $surname;
  global $temp;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) {
      $errname = " * Name is Required";
    } else {
      $tempname = ($_POST["fname"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $tempname)) {
        $errname = " * Only letters and white space allowed";
      } else {
        $good = 1;
        $name = $tempname;
      }
    }

    if (empty($_POST["lname"])) {
      $errsurname = " * Surname is Required";
    } else {
      $tempsurname = ($_POST["lname"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $tempsurname)) {
        $errsurname = " * Only letters and white space allowed";
      } else {
        $surname = $tempsurname;
        $good = 1;
      }
    }
  }
}
function validate_image()
{
  global $good;
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $uploadOk = 1;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $filepath = "images/" . $_FILES["file"]["name"];
    if (empty($target_file)) {
      echo "Enter an image";
      $uploadOk = 0;
    }

    if (file_exists($target_file)) {
      echo "File already exists.";
      $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      echo "Only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    if ($_FILES["file"]["size"] > 600000) {
      echo "Use an image less than 6MB";
      $uploadOk = 0;
    }


    if (move_uploaded_file($_FILES["file"]["tmp_name"], $filepath) && $uploadOk != 0) {
      $good = 1;
      echo "<img src=" . $filepath . " height=450 width=500 />";

    }

  }
}

function validate_phone()
{
  global $number_validated;
  global $errphone;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["mobile"];
    if (preg_match("/^[+91]{3}[0-9]{10}$/", $number)) {
      $number_validated = $number;
      $good = 1;
    } else {
      $errphone = " Enter Number in valid format";
    }
  }
}

function validate_email()
{
  global $erremail;
  global $email_validated;
  $curl = curl_init();
  $em = $_POST["mail"];
  curl_setopt_array($curl, array(

    CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $em,
    CURLOPT_HTTPHEADER => array(
      "Content-Type: text/plain",
      "apikey: EgFVIMYLC78KM6VD65HlOY6k5VpA0CTB"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
  )
  );

  $response = curl_exec($curl);
  $validationResult = json_decode($response, true);
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($validationResult['format_valid'] && $validationResult['smtp_check']) {
      $email_validated = $em;
    } else {
      $erremail = " Enter email in proper format";
    }
    curl_close($curl);
  }
}
function validate_table()
{
  global $marks;
  if (isset($_POST["Marks"])) {

    $temp = explode("\n", $_POST["Marks"]);
    $marks = array();
    foreach ($temp as $value) {
      $line = explode("|", $value);
      if ($line[0] != "") {
        if ($line[1] > 100) {
          $line[1] = "Incorrect input";
        }
        $marks[$line[0]] = $line[1];
      }
    }
  }
}
validate_table();
validate_phone();
validate_input();
validate_email();

?>



<body>

  <div class="container">
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

      <input type="text" placeholder="First Name" id="first-name"
        class="txt txt1" name="fname" value="<?php echo $name; ?>" required>
      <span class="error">
        <?php echo $errname; ?>
      </span>
      <br> <br>
      <input type="text" placeholder="Last Name" id="last-name"
        class="txt txt2" name="lname" value="<?php echo $surname; ?>" required>
      <span class="error">
        <?php echo $errsurname; ?>
      </span>
      <br> <br>

      <div class="para">
        <span class="full-name"></span>
      </div>
      <br>
      <textarea name="Marks" cols="30" rows="10" id="txt-area" required></textarea><br><br>
      <input type="tel" name="mobile" placeholder="Enter Phone Number" required> <span class="error">
        <?php echo $errphone ?>
      </span>
      <br><br>
      <input type="text" name="mail" placeholder="Enter Email" required> <span class="error">
        <?php echo $erremail ?>
      </span><br><br>
      Select image :
      <input type="file" name="file" required><br>
      <input type="submit" name="Submit">
      <br><br>
      <?php
      if (isset($_POST["Submit"]) && $good == 1) {
        echo "Hello {$name} {$surname} <br>";
        echo "Phone Number is" . $number_validated;
        echo "Email ID is" . $email_validated;
      }
      ?>
    </form>
    <div class="img-container">
      <?php
      validate_image();
      ?>
    </div>

  </div>


</body>
<table>
  <tr>
    <th>Subject</th>
    <th>Marks</th>
  </tr>
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

<script>
  var space = " ";
  $(document).ready(function () {

    $(".txt").keyup(function () {
      $(".full-name").text($(".txt1").val() + space + $(".txt2").val());
    });


    $(".txt").keypress(function () {
      $(".error").hide();
    });

    $("#first-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });
    $("#last-name").keydown(function() {
      return /[a-z]/i.test(event.key);
    });

  });
</script>
<?php
session_destroy();
?>

</html>