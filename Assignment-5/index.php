<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <label for="email">Email</label>
        <input type="text" name ="mail"><br><br>
        <input type="submit">
    </form>
</body>

<?php
$curl = curl_init();
$em = $_POST["mail"];
curl_setopt_array($curl, array(

  CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=".$em,
  CURLOPT_HTTPHEADER => array(
    "Content-Type: text/plain",
    "apikey: EgFVIMYLC78KM6VD65HlOY6k5VpA0CTB"
  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET"
));

$response = curl_exec($curl);
$validationResult = json_decode($response, true);
if ($validationResult['format_valid'] && $validationResult['smtp_check']) {
    echo "Your email {$em} is valid";
} else {
    echo "Email is not valid";
}
curl_close($curl);
//echo $response;

?>

</html>