<?php   
session_start();
require ("fpdf186/fpdf.php");
header("content-type:image/jpeg");
$font="C:/xampp/htdocs/myPHP/projet/ecertificat/calibri.ttf";
$time = time();
$date = date('d-m-y');

$image= imagecreatefromjpeg("certificate01.jpg");
$color =imagecolorallocate($image,19,21,22);
imagettftext($image,120,0,1400,1200,$color,$font,$_SESSION['Username']);
imagettftext($image,50,0,1100,1750,$color,$font,$date);

imagejpeg($image,"download-certificate/$time.jpg");


$pdf= new FPDF();
$pdf->AddPage('L','A5');
$pdf->Image("download-certificate/$time.jpg", 0,0,210,148);
ob_end_clean();
$pdf->Output();
?>