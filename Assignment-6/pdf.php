<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();


$name = $_SESSION["fname"];
$surname = $_SESSION["lname"];
$number = $_SESSION["mobile"];
$txt = $_SESSION["Marks"];
require("vendor/autoload.php");
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(0, 10, "Form Details", 1, 1, 'C');
$pdf->setFillColor(230,230,230);
$pdf->Cell(100, 10, "Name", 1, 0, 'C',true);
$pdf->Cell(0, 10, $name, 1, 1, 'C',true);
$pdf->Cell(100, 10, "Surname", 1, 0, 'C');
$pdf->Cell(0, 10, $surname, 1, 1, 'C');
$pdf->Cell(100, 10, "Phone Number", 1, 0, 'C',true);
$pdf->Cell(0, 10, $number, 1, 1, 'C',true);
$pdf->Cell(100, 10, "Email", 1, 0, 'C');
$pdf->Cell(0, 10, $_SESSION["mail"], 1, 1, 'C');
global $marks;
if (isset($_SESSION["Marks"])) {
  $temp = explode("\n", $_SESSION["Marks"]);
    $marks = array();
    $checker = array();
    foreach ($temp as $value) {
      $line = explode("|", $value);

      if ($line[0] != "" && $line[1] != "" ) {
        if(in_array($line[0],$checker)){
        $line[0] = "Duplicate Input";
       // $line[1] = "duplicate input";
      }
        array_push($checker,$line[0]);

        if (($line[1] > 100) || (!is_numeric($line[1]))) {
        $line[1] = "Wrong Input";

        }
        if(is_numeric($line[0])){
        $line[0] = "Wrong Input";
        }
      // print_r($checker);
        $pdf->setFillColor(188, 204, 217);
        $pdf->Cell(100, 10, $line[0], 1, 0, 'C', true);
        $pdf->setFillColor(147, 172, 191);
        $pdf->Cell(0, 10, $line[1], 1, 1, 'C', true);
      }
    }

}

$pdf->Cell(0, 10, "Uploaded Image", 1, 1, 'C');
$pdf->cell(0, 0, $pdf->Image($_SESSION['uploadedImage'], 60, 130, 100, 80), 1, 0, 'C');
$file = 'info-'.time().'.pdf';
$pdf->Output($file, 'I');




?>