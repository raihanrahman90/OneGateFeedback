
<?php
$subject = 'Akun anda telah dinonaktifkan';
include __DIR__.'\..\pesan\header.php';
$text = '<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Aktifasi Akun Customer Service</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <div align="left">
    Akun anda belum dapat diaktifkan, silahkan registrasi ulang pada link berikut <br>
    <a href="'.$link.'register">Klik Disini</a><br>
        Atau hubungi Admin pada email berikut<br>
        nawang.ayunanda@ap1.co.id<br>
        Theodora.Davita@ap1.co.id<br>
        tasyakha.a@gmail.com
  </div>
</div>
</body>
</html>';
$mail->msgHTML($text, __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//send the message, check for errors
    $mail->addAddress($email_customer, $nama_customer);
    $mail->send();
?>