<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["fname"];
    $surname = $_POST["lname"];
    $number = $_POST["mobile"];
    $email = $_POST["mail"];
    $photo = $_POST["file"];
    $txt = $_POST["Marks"];
    require("fpdf/fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial", "B", 10);
    $pdf->Cell(0, 10, "Form Details", 1, 1, 'C');
    $pdf->Cell(100, 10, "Name", 1, 0, 'C');
    $pdf->Cell(0, 10, $name, 1, 1, 'C');
    $pdf->Cell(100, 10, "Surname", 1, 0, 'C');
    $pdf->Cell(0, 10, $surname, 1, 1, 'C');
    $pdf->Cell(100, 10, "Phone Number", 1, 0, 'C');
    $pdf->Cell(0, 10, $number, 1, 1, 'C');
    $pdf->Cell(100, 10, "Email", 1, 0, 'C');
    $pdf->Cell(0, 10, $email, 1, 1, 'C');
    global $marks;
    if (isset($_POST["Marks"])) {

        $temp = explode("\n", $_POST["Marks"]);
        $marks = array();
        foreach ($temp as $value) {
            $line = explode("|", $value);
            if ($line[0] != "") {
                if ($line[1] > 100) {
                    continue;
                }
                $pdf->Cell(100,10,$line[0],1,0,'C');
                $pdf->Cell(0,10,$line[1],1,1,'C');
            }
        }
    }



        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $uploadOk = 1;

        // if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //     $filepath = "images/" . $_FILES["file"]["name"];
        //     if(empty($target_file)){
        //         echo "Enter an image";
        //         //$uploadOk = 0;
        //     }

        //     if (file_exists($target_file)) {
        //         echo "File already exists.";
        //         //$uploadOk = 0;
        //     }

        //     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        //         echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        //        // $uploadOk = 0;
        //     }
        //     if ($_FILES["file"]["size"] > 600000) {
        //         echo "Use an image less than 6MB";
        //         //$uploadOk = 0;
        //     }


        //     if (move_uploaded_file($_FILES["file"]["tmp_name"], $filepath) && $uploadOk!=0){
        //         $good =1;
        //         echo "<img src=" . $filepath . " height=450 width=500 />";

        //     }

        // }
    $pdf->Cell(0, 10, "Uploaded Image", 1, 1, 'C');
    $pdf->Image($target_file,60,100,100,80);
    $file = 'ksi.pdf';

    $pdf->Output($file, 'I');
}



session_destroy();

?>