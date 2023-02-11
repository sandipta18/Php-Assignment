<?php

function validate_phone(){
$number = $_POST["mobile"];
if(preg_match("/^[+91]{3}[0-9]{10}$/", $number)){
    echo $number;
}
else {
    echo "Error";
}
}
validate_phone();
?>