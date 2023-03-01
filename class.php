<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

$good = 0;
class Name
{
    public function validate_input()
    {
        global $good;
        global $errname;
        global $errsurname;
        global $name;
        global $surname;
        global $temp;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["fname"])) {
                $errname = " * Name is Required";
                $good = 0;
            } else {
                $tempname = ($_POST["fname"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/", $tempname)) {
                    $errname = " * Only letters and white space allowed";
                    $good = 0;
                } else {
                    $good = 1;
                    $name = $tempname;
                }
            }

            if (empty($_POST["lname"])) {
                $errsurname = " * Surname is Required";
                $good = 0;
            } else {
                $tempsurname = ($_POST["lname"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/", $tempsurname)) {
                    $errsurname = " * Only letters and white space allowed";
                    $good = 0;
                } else {
                    $surname = $tempsurname;
                    $good = 1;
                }
            }
        }
        $name = array($name, $surname, $errname, $errsurname);
        return $name;
    }
}
class Image
{
    public function validate_image()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            global $good;
            $imagename = $_FILES['image']['name'];
            $tempname = $_FILES['image']['tmp_name'];
            $imagesize = $_FILES['image']['size'];
            $errimage = "";
            //If there's no image name that means that no image was uploaded so displaying error
            if (!$imagename) {
                $errimage = "Enter an image to proceed";
                $good = 0;
            }
            //If image size is greater than 6MB
            else if ($imagesize > 6000000) {
                $errimage = "Enter image less than 6MB";
                $good = 0;
            }
            //If everything is good proceed
            elseif ($imagename != 0) {
                $good = 1;
                $path = "images/" . $imagename;
                move_uploaded_file($tempname, $path);
            }
        }
        $img = array($path, $errimage);
        // return $path;
        return $img;
    }
}
class Phone
{
    public function validate_phone()
    {
        global $number_validated;
        global $errphone;
        global $good;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $number = $_POST["mobile"];
            if (preg_match("/^[+91]{3}[0-9]{10}$/", $number)) {
                $number_validated = $number;
                $good = 1;
            } else {
                $errphone = " Enter Number in valid format";
                $good = 0;
            }
        }
        $phone = array($number_validated, $errphone);
        return $phone;
    }
}
class Email
{

    public function validate_email()
    {

        global $good;
        global $erremail;
        global $email_validated;
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.apilayer.com'
        ]);
        $em = $_POST['mail'];
        $response = $client->request('GET', 'email_verification/check?email=' . $em, [
            'headers' => [
                'apikey' => 'EgFVIMYLC78KM6VD65HlOY6k5VpA0CTB',
            ]
        ]);

        $body = $response->getBody();
        $arr_body = json_decode($body);
        if (empty($_POST['mail'])) {
            $erremail = "Enter Email";
            $good = 0;
        }
        if ($arr_body->format_valid && $arr_body->smtp_check) {
            $email_validated = $em;
            $good = 1;
        } else {
            $erremail = "Enter Email in valid format";
            $good = 0;
        }


        $email = array($email_validated, $erremail);
        return $email;
    }
}
class Table
{
    /**
     * Summary of validate_table
     * This function will validate the input from text area
     * Accepted format of input : Subject|Marks
     * @var mixed $temp
     * @var mixed $line
     * @param array $marks
     * @return array
     */
    public function validate_table()
    {


        global $marks;
        global $good;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Segregating the entire input on the basis on line break
            $temp = explode("\n", $_POST['Marks']);
            // $temp = explode("\n", $_POST["Marks"]);
            $marks = array();
            $checker = array();
            foreach ($temp as $value) {
                // Again segregating the input on the basis of  symbol "|"
                $line = explode("|", $value);
                //If input is not empty proceed
                if ($line[0] != "" && $line[1] != "") {
                    if (in_array($line[0], $checker)) {
                        $line[0] = "duplicate input";
                    }
                    array_push($checker, $line[0]);
                    //Validaing accepted format
                    if (($line[1] > 100) || (!is_numeric($line[1]))) {
                        $line[1] = "Incorrect input";
                    }
                    if (is_numeric($line[0])) {
                        $line[0] = "Incorrect Input";
                    }
                    //If validation is succesfull store the output inside an associative array like (array['Subject']=Marks)
                    $marks[$line[0]] = $line[1];
                    $good = 1;
                }
                
            }
        }
        return $marks;  //return the array consisting of validated data
    }
}
?>