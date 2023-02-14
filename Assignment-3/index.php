<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 2</title>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>



<?php
session_start();
$errname = $errsurname = "";
$name = $surname = "";
$temp;
function validate_input()
{
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
      }
    }
  }
}
function validate_image()
{

  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $uploadOk = 1;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $filepath = "images/" . $_FILES["file"]["name"];

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
      echo "<img src=" . $filepath . " height=450 width=500 />";
    }
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
validate_input();

?>



<body>

  <div class="container">
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

      <input type="text" onkeydown="return /[a-z]/i.test(event.key)" placeholder="First Name" id="first-name" class="txt txt1" name="fname" value="<?php echo $name; ?>">
      <span class="error"><?php echo $errname; ?></span>
      <br> <br>
      <input type="text" onkeydown="return /[a-z]/i.test(event.key)" placeholder="Last Name" id="last-name" class="txt txt2" name="lname" value="<?php echo $surname; ?>">
      <span class="error"><?php echo $errsurname; ?></span>
      <br> <br>

      <div class="para">
        <span class="full-name"></span>
      </div>
      <br><br>
      <textarea name="Marks" cols="30" rows="10" id="txt-area"></textarea><br>
      Select image :
      <input type="file" name="file"><br>
      <input type="submit" name="Submit">
      <br><br>
      <?php
      echo "Hello {$name} {$surname}";

      ?>

    </form>
    <div class="img-container">
      <?php
      validate_image();
      ?>
    </div>

  </div>


</body>
<table >
        <tr>
          <th>Subject</th>
          <th>Marks</th>
        </tr>
        <?php
        foreach ($marks as $key => $output) { ?>
          <tr>
            <td> <?php echo $key; ?>
            <td> <?php echo $output; ?>
          </tr>
        <?php } ?>
</table>


<script>
  var space = " ";
  $(document).ready(function() {

    $(".txt").keyup(function() {
      $(".full-name").text($(".txt1").val() + space + $(".txt2").val());
    });


    $(".txt").keypress(function() {
      $(".error").hide();
    });

  });
</script>
<?php
session_destroy();
?>

</html>