<?php
require_once '../vendor/autoload.php';


use GuzzleHttp\Client;


/**
 * @method validate_password
 * 
 * @method validate_email
 * 
 */
class Validate{
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
  public function validate_password($password){

    if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password)) {
      return FALSE;
    } 
    else {
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
  public function validate_email($em){

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
    } 
    else {
      return false;
    }
  }
}

?>
