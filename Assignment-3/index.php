<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        Enter Marks in this format<br>
        Subject|Marks-Obtained<br><br>
        <textarea name="Marks"  cols="30" rows="10"   id="txt-area" >


        </textarea><br>

        <button onclick="Validate()">Submit</button>

    </form>
    <?php
    function random(){
    echo "Error";
    }
    function esehi(){
        echo $_POST["Marks"];
    }
    ?>
</body>
<?php
// if(isset($_POST["press"])){
// $temp = $_POST["Marks"];
// if (!preg_match ("/^([A-Za-z0-9]+\.[A-Za-z0-9]+(\r)?(\n)?)+$/", $name) ) {
//     echo "error";
//  }

// else{
//           echo $temp;
//        }
// //echo $temp;
// }
// ?>
<script>



function Validate()
{
    var usernamecheck = /^([A-Za-z0-9]+\.[A-Za-z0-9]+(\r)?(\n)?)+$/;

    if(!$.trim(document.all.Marks.value).match(usernamecheck))
    {
        <?php
        random();
        ?>
    }
    else{
        esehi();
    }

}

</script>
</html>