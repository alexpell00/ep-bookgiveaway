<?php

	$token = $_GET['t'];
	$bookid = 0;
	$email;
	$title;
	$author;
	$blurb;
	$filename;
	$cover;

	$sql = "SELECT * FROM `RequestedBooks` WHERE `token`='$token'";
	$sqlAccount = new mysqli('localhost', 'user-1941', 'mDfj()la.8In3', 'EP_GiveAways');
	$result = $sqlAccount->query($sql);
	$sqlAccount->close();
	$wasFound = false;
	if ($result != false){
		while($row = $result->fetch_assoc()){
		    $wasFound = true;
		    $bookid = $row['bookid'];
		    $email = $row['email'];
		}
	}
	if ($wasFound){
		$sql = "SELECT * FROM Books WHERE id=$bookid";
		$sqlAccount = new mysqli('localhost', 'user-1941', 'mDfj()la.8In3', 'EP_GiveAways');
		$result = $sqlAccount->query($sql);
		$sqlAccount->close();
		$wasFound = false;
		if ($result != false){
			while($row = $result->fetch_assoc()){
			    $title = $row['title'];
			    $author = $row['author'];
			    $blurb = $row['blurb'];
			    $filename = $row['filename'];
			    $cover = $row['coverImage'];
			    $wasFound = true;
			}
		}
	}
	if ($wasFound){
		// Create the image with text
		$im = imagecreatetruecolor(400, 15);
		imagefilledrectangle($im, 0, 0, 399, 29, imagecolorallocate($im, 255, 255, 255));
		$font = 'arialbd.ttf';
		$black = imagecolorallocate($im, 0, 0, 0);
		imagettftext($im, 10, 0, 10, 10, $black, $font, $email);
		imagepng($im, "$token.png");


		require_once("fpdf/fpdf.php");
		require_once("fpdi/fpdi.php");
		require_once("pdfwatermarker/pdfwatermarker.php");
		require_once("pdfwatermarker/pdfwatermark.php");
		//Specify path to image
		$watermark = new PDFWatermark($_SERVER['DOCUMENT_ROOT'] . "/$token.png"); 
		//Specify the path to the existing pdf, the path to the new pdf file, and the watermark object
		$watermarker = new PDFWatermarker($_SERVER['DOCUMENT_ROOT'] . "/promo-books/$filename",$_SERVER['DOCUMENT_ROOT'] . "/promo-books/$token.pdf",$watermark); 
		//Set the position
		$watermarker->setWatermarkPosition('topright');
		//Save the new PDF to its specified location
		$watermarker->watermarkPdf();

		header("Content-type:application/pdf");

// It will be called downloaded.pdf
		header("Content-Disposition:attachment;filename='$filename'");
		readfile("promo-books/$token.pdf");

		$sql = "DELETE FROM `RequestedBooks` WHERE `token`='$token'";
		$sqlAccount = new mysqli('localhost', 'user-1941', 'mDfj()la.8In3', 'EP_GiveAways');
		$result = $sqlAccount->query($sql);
		$sqlAccount->close();

		unlink($_SERVER['DOCUMENT_ROOT'] . "/$token.png");
		unlink($_SERVER['DOCUMENT_ROOT'] . "/promo-books/$token.pdf");
	}




function image_data($gdimage)
{
    ob_start();
    imagejpeg($gdimage);
    return(ob_get_clean());
}
?>