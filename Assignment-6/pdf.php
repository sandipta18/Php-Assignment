<?php
session_start();
   

    $name = $_SESSION["fname"];
    $surname = $_SESSION["lname"];
    $number = $_SESSION["mobile"];
    $txt = $_SESSION["Marks"];
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
    $pdf->Cell(0, 10, $_SESSION["mail"], 1, 1, 'C');
    global $marks;
    if (isset($_SESSION["Marks"])) {

        $temp = explode("\n", $_SESSION["Marks"]);
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

    $pdf->Cell(0, 10, "Uploaded Image", 1, 1, 'C');
    $pdf->cell(0,0,$pdf->Image($_SESSION['uploadedImage'],60,100,100,80),1,0,'C');

    $file = 'ksi.pdf';
    $pdf->Output($file, 'I');




?>
