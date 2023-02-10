<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <style>
        .container{
           height:90vh;
           width:90vw;

        }
        form{
            padding:100px 100px;
        }
        .error{
            color:red;
            font-weight:bold;
        }
        .para{
            height:20px;
            width:175px;
            border:1px solid black;
             display:flex;
            align-items:center;
            justify-content:flex-start;
        }
   </style>
</head>
<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }

    $errname = $errsurname = "";
    $name = $surname="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["fname"])){
            $errname = " * Name is Required";
        }
        else{
            $tempname = check($_POST["fname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$tempname)) {
                $errname = " * Only letters and white space allowed";
            }
            else{

                $name = $tempname;
            }
        }

        if(empty($_POST["lname"])){
            $errsurname = " * Surname is Required";
        }
        else{
            $tempsurname = check($_POST["lname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$tempsurname)) {
                $errsurname = " * Only letters and white space allowed";
            }
            else{

                $surname = $tempsurname;
            }
        }
    }
    function check($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
        <input type="text" placeholder="First Name" id="first-name" class="txt" name="fname" value="<?php echo $name; ?>" >
        <span class="error"><?php echo $errname; ?></span>
        <br> <br>
        <input type="text" placeholder="Last Name" id="last-name" class="txt2"  name="lname" value="<?php echo $surname; ?>" >
        <span class="error"><?php echo $errsurname; ?></span>
        <br> <br>
        <div class="para">
        <p class="p1"></p><p class="p2"></p2>
        </div>
        <br> <br>
        <input type="submit" class="submit">
        <br><br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "Hello " . $name ." ". $surname;
        }
    ?>
    </form>

    </div>
    <?php

    ?>

</body>
<script>
    $(document).ready(function () {

    $(".txt").keyup(function () {
      $(".p1").text($(".txt").val());
    });
    $(".txt2").keyup(function () {
      $(".p2").text($(".txt2").val());
    });


  });
</script>
</html>
