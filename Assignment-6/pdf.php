<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

        $name = $_POST["fname"];
        $surname = $_POST["lname"];
        $number = $_POST["mobile"];
        $email = $_POST["mail"];
        $photo = $_POST["file"];
        $txt = $_POST["Marks"];
        require("fpdf/fpdf.php");
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont("Arial","B",10);
            $pdf->Cell(0,10,"Form Details",1,1,'C');
            $pdf->Cell(70,10,"Name",1,0,'C');
            $pdf->Cell(0,10,$name,1,1,'C');
            $pdf->Cell(70,10,"Surname",1,0,'C');
            $pdf->Cell(0,10,$surname,1,1,'C');
            $pdf->Cell(70,10,"Phone Number",1,0,'C');
            $pdf->Cell(0,10,$number,1,1,'C');
            $pdf->Cell(70,10,"Email",1,0,'C');
            $pdf->Cell(0,10,$email,1,1,'C');
            if(isset[$_POST[]])
            $file = 'ksi.pdf';
            $pdf->Output($file,'D');
    }



    session_destroy();
?>