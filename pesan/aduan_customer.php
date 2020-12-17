
<?php
$subject = 'Feedback Bandara SAMS Sepinggan Balikpapan';
include '../pesan/header.php';
$text = '<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Aktifasi Akun Customer Service</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <div align="left">
   Terima kasih atas feedback yang anda berikan
   Feedback dengan nomor antrian '.$id_keluhan.' telah terkirim, anda bisa memantau perkembangan dari feedback anda pada halaman berikut pada link berikut<br> 
   <a href="'.$link.'customer/tampil_antri.php?id='.$id_keluhan.'">Klik di sini</a><br>
   Feedback yang anda berikan bisa anda ubah dalam waktu 30 menit setelah pengiriman atau klik link di bawah ini agar customer service bisa segera menindak lanjuti feedback anda<br>
   <a href="'.$link.'action/terima.php?id='.$id_keluhan.'">Klik di sini</a>
  </div>
</div>
</body>
</html>';
$mail->msgHTML($text, __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//send the message, check for errors
    $mail->addAddress($email, $nama);
    if (!$mail->send()) {
        $pesan = false;
    } else {
        $pesan = true;
    }
?>