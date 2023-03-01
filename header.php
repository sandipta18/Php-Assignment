<?php 
session_start();
if($_SESSION['set']==FALSE){
  header('location: ../Assignment-7/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<title></title>
<style>


  .cf:before,
  .cf:after {
      content: " ";
      display: table;
  }

  .cf:after {
      clear: both;
  }

  .cf {
      *zoom: 1;
  }

  .menu,
  .submenu {
   margin: 0;
   padding: 0;
   list-style: none;
  }

  .menu {
   margin:auto;
   width:800px;
   width: -moz-fit-content;
   width: -webkit-fit-content;
   width:fit-content;
  }

  .menu > li {
   background: #17181D;
   float: left;
   position: relative;
   transform: skewX(25deg);
  }

  .menu a {
   display: block;
   color: #fff;
   text-transform: uppercase;
   text-decoration: none;
   font-family: Arial, Helvetica;
   font-size: 14px;
  }

  .menu li:hover {
   background: #e74c3c;
  }

  .menu > li > a {
   transform: skewX(-25deg);
   padding: 1em 2em;
  }


  .submenu {
   position: absolute;
   width: 200px;
   left: 50%; margin-left: -100px;
   transform: skewX(-25deg);
   transform-origin: left top;
  }

  .submenu li {
   background-color: #34495e;
   position: relative;
   overflow: hidden;
  }

  .submenu > li > a {
   padding: 1em 2em;
  }

  .submenu > li::after {
   content: '';
   position: absolute;
   top: -125%;
   height: 100%;
   width: 100%;
   box-shadow: 0 0 50px rgba(0, 0, 0, .9);
  }

  .submenu > li:nth-child(odd){
   transform: skewX(-25deg) translateX(0);
  }

  .submenu > li:nth-child(odd) > a {
   transform: skewX(25deg);
  }

  .submenu > li:nth-child(odd)::after {
   right: -50%;
   transform: skewX(-25deg) rotate(3deg);
  }

  .submenu > li:nth-child(even){
   transform: skewX(25deg) translateX(0);
  }

  .submenu > li:nth-child(even) > a {
   transform: skewX(-25deg);
  }

  .submenu > li:nth-child(even)::after {
   left: -50%;
   transform: skewX(25deg) rotate(3deg);
  }


  .submenu,
  .submenu li {
   opacity: 0;
   visibility: hidden;
  }

  .submenu li {
   transition: .2s ease transform;
  }

  .menu > li:hover .submenu,
  .menu > li:hover .submenu li {
   opacity: 1;
   visibility: visible;
  }

  .menu > li:hover .submenu li:nth-child(even){
   transform: skewX(25deg) translateX(15px);
  }

  .menu > li:hover .submenu li:nth-child(odd){
   transform: skewX(-25deg) translateX(-15px);
  }
</style>
</head>
<body>
<ul class="menu cf">
<li><a href="https://github.com/sandipta18/Php-Assignment">Repo Link</a></li>
<li><a href="../Assignment-1/index.php">Task 1</a></li>
<li><a href="../Assignment-2/index.php">Task 2</a></li>
<li><a href="../Assignment-3/index.php">Task 3</a></li>
<li><a href="../Assignment-4/index.php">Task 4</a></li>
<li><a href="../Assignment-5/index.php">Task 5</a></li>
<li><a href="../Assignment-6/index.php">Task 6</a></li>
<li><a href="../Assignment-7/index.php">Task 7</a></li>

<li>
        <a>OOPS</a>
        <ul class="submenu">
<li><a href="../Assignment-1-oops/index.php">Task-1-OOPS</a></li>
<li><a href="../Assignment-1-session/index.php">Task-1-SESSION</a></li>
<li><a href="../Assignment-2-oops/index.php">Task-2-OOPS</a></li>
<li><a href="../Assignment-3-oops/index.php">Task-3-OOPS</a></li>
<li><a href="../Assignment-4-oops/index.php">Task-4-OOPS</a></li>
<li><a href="../Assignment-5-oops/index.php">Task-5-OOPS</a></li>
<li><a href="../Assignment-6-oops/index.php">Task-6-OOPS</a></li>
</ul>
</li>
<li><a href="../Assignment-7/logout.php">Logout</a></li>
</ul>
</body>
</html>