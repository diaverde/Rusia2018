<!DOCTYPE html>
<html lang="es">
<head>  
    <title>Gracias por contactarnos</title>
</head>

<body>

<?php

//$email_to = "diaverde77@gmail.com"; // your email address
$email_to = "gerencia@nosvamosparusia.com"; // your email address
$email_subject = "Mensaje del Formulario"; // email subject line
//$thankyou = "thankyou.htm"; // thank you page

// if you update the question on the form -
// you need to update the questions answer below
$antispam_answer = "4";

if(isset($_POST['email'])) {	
	
	function died($error) {
		echo "Oops! Parece que ha habido un error con su formulario. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		?>
		<a href="../index.html">Volver a la página principal</a>
		<?php
		die();
	}
	
	if(!isset($_POST['name']) ||
		!isset($_POST['email']) ||
        !isset($_POST['city']) ||
        !isset($_POST['country']) ||
		!isset($_POST['comments']) ||
		!isset($_POST['antispam'])
        ){
		died('Sorry, there appears to be a problem with your form submission.');		
	}
	
	$full_name = $_POST['name']; // required
	$email_from = $_POST['email']; // required
	$phone = $_POST['phone']; // not required
	$city = $_POST['city']; // required
    $country = $_POST['country']; // required
//    $otcountry = $_POST['otcountry']; // required
	$comments = $_POST['comments']; // required
    $antispam = $_POST['antispam']; // required
    //$antispam = 4;
	
	$error_message = "";
	
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    
    if(preg_match($email_exp,$email_from)==0) {
  	    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }
    if(strlen($full_name) < 2) {
  	    $error_message .= 'Your Name does not appear to be valid.<br />';
    }
    if(strlen($comments) < 2) {
  	    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }
  
    if($antispam <> $antispam_answer) {
	    $error_message .= 'The Anti-Spam answer you entered is not correct.<br />';
    }
  
    if(strlen($error_message) > 0) {
  	    died($error_message);
    }
    
    $email_message = "Se ha recibido este mensaje.\r\n";
	
	function clean_string($string) {
	    $bad = array("content-type","bcc:","to:","cc:");
	    return str_replace($bad,"",$string);
	}
	
	$email_message .= "Nombre del cliente: ".clean_string($full_name)."\r\n";
	$email_message .= "Email: ".clean_string($email_from)."\r\n";
	$email_message .= "Teléfono: ".clean_string($phone)."\r\n";
    $email_message .= "Ciudad: ".clean_string($city)."\r\n";
    $email_message .= "País: ".clean_string($country);
	if (isset($_POST['otcountry'])) {
	    $otcountry = $_POST['otcountry']; // required
		$email_message .= " - ".clean_string($otcountry);
	}
	$email_message .= "\r\n";
	$email_message .= "Mensaje: ".clean_string($comments)."\r\n";
	
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email_to, $email_subject, $email_message, $headers);    
}
?>

<h1>Gracias por contactarnos</h1>
<h2>Le responderemos a la brevedad</h2>

<h3><a href="../index.html">Volver a la página principal</a></h3>

</body>
</html>
