<?php
	if($_POST['name']){
		$headers = "From: FUSE Website <fuse@trinix.co>\r\n";
		$headers .= "Reply-To: ".$_POST['name']." <".$_POST['email'].">\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
		
		$message = $_POST['message']."<br /><br /><small>sent via FUSE website</small>";
		
		$to = $_POST['to'];
		$subject = "Website Email From ".$_POST['name'];
		
		if(mail($to, $subject, $message, $headers)){
		    echo '<div class="alert alert-success" role="alert"><b>Thanks!</b> Your message was sent. I usually reply within 24 hours.</div>'; // success      
		}else{
		    echo '<div class="alert alert-danger" role="alert"><b>Barnacles!</b> Your message failed to send. You can email me directly at '.$_POST['to'].'.</div>'; // failure
		}
	}else{
		die;
	}
?>