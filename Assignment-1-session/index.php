<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
                                                   //This will keep the session active
                                  //This will come handy when the user have entered the wrong form data
                                                   //and while re entering the data in form user doesn't have to start from scratch.
                                                   ini_set('display_errors', 1);
                                                   ini_set('display_startup_errors', 1);
                                                   error_reporting(E_ALL);
    $errname = "";
    $errsurname = "";
    $name = "";
    $surname = "";
    $temp;
    $good = 0;
    $first_name= "";
    $sur_name = "";
    function validate()
    {
        global $errname;
        global $errsurname;
        global $name;
        global $surname;
        global $good;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["fname"])) {
                $errname = " * Name is Required";
                $good = 0;
            }
            else{
                $tempname = ($_POST["fname"]);
               if (!preg_match("/[a-zA-Z-' ]*$/",$tempname)) {
                   $errname = " * Only letters and white space allowed";
                   $good = 0;
                 }
                 else{
                   $name = $tempname;
                   $good = 1;
                 }
           }

            if (empty($_POST["lname"])) {
                $errsurname = " * Surname is Required";
                $good = 0;
            }
            else{
                $tempsurname = ($_POST["lname"]);
               if (!preg_match("/^[a-zA-Z-' ]*$/",$tempsurname)) {
                   $errsurname = " * Only letters and white space allowed";
                   $good = 0;
                }
                else{
                  $surname = $tempsurname;
                  $good = 1;
                }
           }


        }
    }
    validate();
    ?>

    <div class="container">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input type="text" onkeydown="return /[a-z]/i.test(event.key)" placeholder="First Name" id="first-name" class="txt txt1" name="fname" required value="<?php echo $name; ?>" >
            <span class="error"><?php echo $errname; ?></span>
            <br> <br>
            <input type="text" onkeydown="return /[a-z]/i.test(event.key)" placeholder="Last Name" id="last-name" class="txt txt2" name="lname" required value="<?php echo $surname; ?>" >
            <span class="error"><?php echo $errsurname; ?></span>
            <br> <br>

            <div class="para">
            <span class="full-name"></span>
            </div>

            <br> <br>
            <input type="submit" class="submit">
            <br><br>



        </form>

    </div>


</body>


<script>
    var space = " ";
    $(document).ready(function() {

        $(".txt").keyup(function() {
            $(".full-name").text($(".txt1").val()+space+$(".txt2").val());
        });


        $(".txt").keypress(function() {
            $(".error").hide();
        });




    });
</script>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
validate();
if($good == 1){
$_SESSION['first_name'] = $name;
$_SESSION["sur_name"] = $surname;
header("Location:action.php");
}
}


?>
</html>

