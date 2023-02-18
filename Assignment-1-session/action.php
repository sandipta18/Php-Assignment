<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();
echo "Hello".$_SESSION['firstname'] . $_SESSION['surname'];
?>