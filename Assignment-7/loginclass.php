<?php 

/**
 * 
 * @method validate_login()
 * 
 */
class Login{

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
  public function validate_login() {

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
        $_SESSION['checker'] = $_POST['Password'];
        $_SESSION['name'] = $_POST['Name'];
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

?>
