<!-- this will redirect user on the basis of query value entered by user like [?q=] -->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $page = $_POST['q'];
  if ($page == 1) {
    header('Location: ../Assignment-1/index.php');
  } elseif ($page == 2) {
    header('Location: ../Assignment-2/index.php');
  } elseif ($page == 3) {
    header('Location: ../Assignment-3/index.php');
  } elseif ($page == 4) {
    header('Location: ../Assignment-4/index.php');
  } elseif ($page == 5) {
    header('Location: ../Assignment-5/index.php');
  } elseif ($page == 6) {
    header('Location: ../Assignment-6/index.php');
  } elseif ($page == 7) {
    header('Location: ../Assignment-7/index.php');
  } else {
    $_SESSION['error'] = "Enter value from 1-7";
    header("Location:action.php");

  }
}

?>