<?php
require_once '../vendor/autoload.php';


use GuzzleHttp\Client;


class validate
{
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
  /**
   * This function will be used to validate the password entered by user
   * 
   * @param mixed $password
   * 
   * @return boolean
   */
  function validate_password($password)
  {
    if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password)) {
      return FALSE;
    } else {
      return TRUE;
    }
  }


  /**
   * This function is used to validate the email id entered by user using guzzlehttp
   * 
   * @param mixed $em
   * 
   * @return boolean
   * 
   */
  function validate_email($em)
  {



    // $client = new Client([
    //     // Base URI is used with relative requests
    //     'base_uri' => 'https://api.apilayer.com'
    // ]);
    // $response = $client->request('GET', 'email_verification/check?email=' . $em, [
    //     'headers' => [
    //         'apikey' => 'EgFVIMYLC78KM6VD65HlOY6k5VpA0CTB',
    //     ]
    // ]);

    // $body = $response->getBody();
    // $arr_body = json_decode($body);
    // if ($arr_body->format_valid && $arr_body->smtp_check) {
    //     return TRUE;
    // } 
    // else {
    //    return FALSE;
    // }

    // Api is malfunctioning since 2days so adding another layer of validation

    if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
      return true;
    } else {
      return false;
    }
  }
}


/**
 * [Description Login]
 * @method validate_login()
 */
class Login
{

  /**
   * 
   * This function is used to facilitate the login process
   * First Data is taken from user and it is validated. If error occurs and error is returned
   * If there is no error connection with database is established and the login ID ans Password
   * is checked inside the database. If Account exists then user is logged in
   * else error is thrown
   * 
   * 
   * @return array
   * 
   */
  function validate_login()
  {
    require 'databaseinfo.php';
    $link = mysqli_connect($servername, $username, $password, $database);
    if (!$link) {
      die(mysqli_connect_error());
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
      //If everything is fine query is executed
      $query = "select * from Signup where UserName = '$user_name' and Pass_word = '$password'";
      $result = mysqli_query($link, $query);
      $count = mysqli_num_rows($result);
      //If account exists user will be logged in
      if ($count > 0) {
        $_SESSION['name'] = ucwords(strtolower($_POST['Name']));
        $_SESSION['set'] = true;
        header("Location:action.php");
      }
      //If account doesnot exist error will be thrown
      else {
        $errorname = "Enter Credentials Correctly";
      }
    }
    $output = array($user_name, $password, $errorname, $errorpassword);
    return $output;
  }
}



/**
 * @method account_exist
 */
class exist
{

  /**
   * @param mixed $email
   * 
   * @return boolean
   * 
   * This method will be used to check whether an account exists or not
   */
  function account_exist($email)
  {
    require 'databaseinfo.php';
    $link = mysqli_connect($servername, $username, $password, $database);
    $sql = "select * from Signup where Email = '$email' ";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) != 1) {
      return FALSE;
    } else {
      return TRUE;
    }
  }
}
?>