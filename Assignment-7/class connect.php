<?php
/**
 * @method establist_connection
 */
class Connection{

  /**
   * 
   * This function will facilitate establishing a connection with database
   * @param mixed $link
   * 
   * @return boolean
   */
  public function establish_connection ($link) {
    if (!$link) {
      die(mysqli_connect_error());
      return false;
    }
    else {
      return true;
    }
       
  }
}
?>