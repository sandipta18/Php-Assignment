
<?php


/**
 * @method account_exist
 */
class Exist {

  /**
   * @param mixed $email
   * 
   * @return boolean
   * 
   * This method will be used to check whether an account exists or not
   */
  public function account_exist ($email)
  {
    require 'databaseinfo.php';
    $link = mysqli_connect($servername, $username, $password, $database);
    $sql = "select * from Signup where Email = '$email' ";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) != 1) {
      return FALSE;
    } 
    else {
      return TRUE;
    }
  }
}

?>