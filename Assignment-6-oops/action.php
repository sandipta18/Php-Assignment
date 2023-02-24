<?php
session_start();
  require('../class.php');

  if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Created an object to call the function(validate_name)inside it for validation
    $obj = new Name();
    $temp = $obj->validate_input();
    $obj3 = new Table();
    $marks = $obj3->validate_table();
    $obj4 = new Phone();
    $temp2 = $obj4->validate_phone();
    $obj5 = new Email();
    $temp3 = $obj5->validate_email();
    $obj2 = new Image();
    $image_info = $obj2->validate_image();
  }

$_SESSION["fname"] = ucwords(strtolower($temp[0]));
$_SESSION["lname"] = ucwords(strtolower($temp[1]));
$_SESSION["mobile"] = $temp2[0];
$_SESSION["mail"] = $temp3[0];
$_SESSION["Marks"] = $_POST["Marks"];
$_SESSION["Image"] = $image_info[0];
if ($good == 1) {
    header("Location:pdf.php");
}
?>
