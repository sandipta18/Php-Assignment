<?php 
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
session_start();
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
require 'databaseinfo.php';
require 'class.php';
$link = mysqli_connect($servername, $username, $password, $database);
$_SESSION['passvalidate'] = true;
$_SESSION['wrongpass'] = "";
$_SESSION['account_delete'] = false;
$_SESSION['deletemessage'] = "";
if($_SESSION['checker'] != $_POST['deletepass']){
    $_SESSION['passvalidate'] = false;
    $_SESSION['wrongpass'] = "Password DO NOT MATCH";
    header('location:delete.php');

}
else{
$obj = new connection();
if($obj->establish_connection($link)){
    $name_delete =  $_SESSION['name'];
    $pass_delete = md5($_SESSION['checker']);
    $sql = "Delete from Signup where UserName = '$name_delete' and Pass_word = '$pass_delete' ;";
    $result = mysqli_query($link,$sql);
    $_SESSION['account_delete'] = true;
    $_SESSION['deletemessage'] = "Account Deleted";
    header('location:index.php');
    
}
else{
    die(mysqli_connect_error());
    header('location:index.php');
}
}
?>