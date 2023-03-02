<?php
include '../Assignment-7/loadin.php';
  require('../class.php');
  if ($_SERVER['REQUEST_METHOD'] == "POST") {     //Created an object to call the function inside it for validation
    $obj = new Name();
    $temp = $obj->validate_input();
  }

  ?>