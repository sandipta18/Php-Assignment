<!-- This document will facilitate deletion of account from the database -->
<?php 

session_start();

// This file contains database information
require 'databaseinfo.php';
// This clss file facilitates validation
require 'class.php';
// This class file facilitates establishing a connection
require 'class connect.php';

$link = mysqli_connect($servername, $username, $password, $database);
$_SESSION['passvalidate'] = true;
$_SESSION['wrongpass'] = "";
$_SESSION['account_delete'] = false;
$_SESSION['deletemessage'] = "";

// If the entered password does not matches with the password associated with account
// an error is thrown
if ($_SESSION['checker'] != $_POST['deletepass']) {
    $_SESSION['passvalidate'] = false;
    $_SESSION['wrongpass'] = "Password DO NOT MATCH";
    header('location:delete.php');

}
// If both the password matches account is deleted
else {
$obj = new Connection();
if ($obj->establish_connection($link)) {
    $name_delete =  $_SESSION['name'];
    $pass_delete = md5($_SESSION['checker']);
    // query to delete account
    $sql = "Delete from Signup where UserName = '$name_delete' and Pass_word = '$pass_delete' ;";
    $result = mysqli_query($link,$sql);
    $_SESSION['account_delete'] = true;
    $_SESSION['deletemessage'] = "Account Deleted";
    header('location:index.php');
    
}
else {
    die(mysqli_connect_error());
    header('location:index.php');
}
}
?>