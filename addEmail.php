<?php
require 'vendor/autoload.php';
	$MailChimp = new \Drewm\MailChimp('060db7d5886960997d26a0bad0105840-us3');
	$result = $MailChimp->call('lists/subscribe', array(
                'id'                => 'c899e1ad9b',
                'email'             => array('email'=>$_POST['email']),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => false,
            ));
	if ($result['error']){
		echo($result['error']);
	}else{
		$to      = $_POST['email'];
		$subject = "Book Of The Week";
		$token = md5(uniqid(mt_rand(), true));
		$message = "http://www.entangledpublishing.com/getBook.php?t=$token";
		$headers = 'From: no-reply@entangledpublishing.com' . "\r\n" .
		    'Reply-To: no-reply@entangledpublishing.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);

		
		$bookid = $_POST['book'];
		$time = time();
		$sql = "INSERT INTO `RequestedBooks`(`token`, `bookid`, `timeRequested`,`email`) VALUES ('$token', $bookid, $time , '" . $_POST['email'] . "')";
		$sqlAccount = new mysqli('localhost', 'user-1941', 'mDfj()la.8In3', 'EP_GiveAways');
		$result = $sqlAccount->query($sql);
		$sqlAccount->close();


		echo("102");
	}
	
	

?>

