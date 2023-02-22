
<?php
  require('../class.php');
  if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Created an object to call the function inside it for validation
    $obj = new Name();
    $temp = $obj->validate_input();
    $obj2 = new Image();
    $temp1 = $obj2->validate_image();
  }



?>