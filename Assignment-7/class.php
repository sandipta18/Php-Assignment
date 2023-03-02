<?php 
require_once '../vendor/autoload.php';

use GuzzleHttp\Client;

/**
 * [Description password]
 * Will be used to validate the password entered by the user
 */
class validate{
    /*
    Regular Expression: $\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$
    $ = beginning of string
    \S* = any set of characters
    (?=\S{8,}) = of at least length 8
    (?=\S*[a-z]) = containing at least one lowercase letter
    (?=\S*[A-Z]) = and at least one uppercase letter
    (?=\S*[\d]) = and at least one number
    (?=\S*[\W]) = and at least a special character (non-word characters)
    $ = end of the string
 */
  function validate_password($password){
    if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password)){
    return FALSE;
    }
    else{
        return TRUE;
    }
  }
  

  function validate_email($em){
  
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.apilayer.com'
    ]);
    $response = $client->request('GET', 'email_verification/check?email=' . $em, [
        'headers' => [
            'apikey' => 'EgFVIMYLC78KM6VD65HlOY6k5VpA0CTB',
        ]
    ]);

    $body = $response->getBody();
    $arr_body = json_decode($body);
    if ($arr_body->format_valid && $arr_body->smtp_check) {
        return TRUE;
    } 
    else {
       return FALSE;
    }


  }

}


class Login
{

  function validate_login()
  {
    $servername = 'localhost';
    $username = 'sandipta';
    $password = '182001@Mimo';
    $database = 'Assignment_7';
    $link = mysqli_connect($servername, $username, $password, $database);
    if (!$link) {
      die( mysqli_connect_error());
    }
    
    global $errorname;
    global $errorpassword;
    global $user_name;
    global $password;
    $_SESSION['set'] = false;
    $errorname = "";
    $errorpassword = "";
    $user_name = $_POST["Name"];
    $password = md5($_POST["Password"]);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      //If name is empty throw error
      if (empty($_POST["Name"])) {
        $errorname = "Please Enter Name";
      }
      //IF password is empty throw error
      if (empty($_POST["Password"])) {
        $errorpassword = "Please Enter Password";
      }
      $query = "select * from Signup where UserName = '$user_name' and Pass_word = '$password'";
      $result = mysqli_query($link,$query);
      $count = mysqli_num_rows($result);
      if($count>0){
        $_SESSION['name'] = ucwords(strtolower($_POST['Name']));
        $_SESSION['set'] = true;
        header("Location:action.php");
      }
      else{
        $errorname = "Enter User Name Correctly";
        $errorname = "Enter User Name Correctly";
      }
    }
    $output = array($user_name, $password, $errorname, $errorpassword);
    return $output;
  }
}
?>