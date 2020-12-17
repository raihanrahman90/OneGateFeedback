<?php
    include '../link.php';
    include '../pesan/kirim_notif.php';
    include '../koneksi.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    //Create a new PHPMailer instance
	//Tell PHPMailer to use SMTP
	$mail = new PHPMailer;
    $mail->isSMTP();
    //Enable SMTP debugging
    // SMTP::DEBUG_OFF = off (for production use)
    // SMTP::DEBUG_CLIENT = client messages
    // SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    //Ubah dengan hostname mail server
    // use
    $mail->Host = 'smtp.gmail.com';
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption mechanism to use - STARTTLS or SMTPS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'serviceimprovementbpn@gmail.com';
    //Password to use for SMTP authentication
    $mail->Password = 'Airport2020';
    //Set who the message is to be sent from
    $mail->setFrom('serviceimprovementbpn@gmail.com', 'Customer Service Bandara SAMS Sepinggan Balikpapan');
    //Set an alternative reply-to address
    $mail->addReplyTo('serviceimprovementbpn@gmail.com', 'Customer Service Bandara SAMS Sepinggan Balikpapan');
    //Set who the message is to be sent to
    //Set the subject line
    $mail->Subject = $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';

?>