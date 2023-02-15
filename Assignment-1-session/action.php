<?php
session_start();
echo "Hello"." ".$_SESSION["first_name"]." ".$_SESSION["sur_name"];

?>