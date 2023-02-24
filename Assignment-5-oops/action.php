<?php

  require('../class.php');
  if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Created an object to call the function(validate_name)inside it for validation
    $obj = new Name();
    $temp = $obj->validate_input();
    $obj2 = new Image();
    $temp1 = $obj2->validate_image();
    $obj3 = new Table();
    $marks = $obj3->validate_table();
    $obj4 = new Phone();
    $temp2 = $obj4->validate_phone();
    $obj5 = new Email();
    $temp3 = $obj5->validate_email();
  }

?>
