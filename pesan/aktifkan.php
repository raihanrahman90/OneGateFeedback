
<?php
$subject ='Aktivasi Akun';
include __DIR__.'\..\pesan/header.php';
$text = '<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Aktivasi Akun Customer Service</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <div align="left">
    Akun Customer Service Bandara SAMS Sepinggan Balikpapan anda telah aktif, silahkan login dari tautan berikut untuk mengirimkan feedback kepada Bandara SAMS Sepinggan Balikpapan<br>
    <a href="'.$link.'">Klik Disini</a>
  </div>
</div>
</body>
</html>';
$mail->msgHTML($text, __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
$mail->Subject = 'Akun anda telah diverifikasi';
//Attach an image file
//send the message, check for errors
    $mail->addAddress($email_customer, $nama_customer);
    $mail->send();
$query = mysqli_query($koneksi, "SELECT token, Email, Nama from tb_customer inner join tb_token on tb_customer.id_customer = tb_token.id where email='$email_customer' and tb_token.status='customer'");
if($result = mysqli_fetch_array($query)){
    sendPushNotification(
        $result['token'], 
        'Aktivasi Akun', 
        'Akun anda berhasil diverifikasi, silahkan login',
        '/login',
        '',
        ''
    );
}

?>