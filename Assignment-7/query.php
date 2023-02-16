<?php
session_start();

if($_SERVER['REQUEST_METHOD']=="POST"){
switch ($_POST['query']) {
  case '1':
    header('Location: ../Assignment-1/index.php');
    break;
  case '2':
    header('Location: ../Assignment-2/index.php');
    break;
  case '3':
    header('Location: ../Assignment-3/index.php');
    break;
  case '4':
    header('Location: ../Assignment-4/index.php');
    break;
  case '5':
    header('Location: ../Assignment-5/index.php');
    break;
  case '6':
    header('Location: ../Assignment-6/index.php');
    break;
  default:

    header('Location: index.php');
}
}

?>