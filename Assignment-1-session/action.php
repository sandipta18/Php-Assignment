<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();
//Printing the data received via session
echo "Hello ".$_SESSION['firstname'] . " ". $_SESSION['surname'];
?>