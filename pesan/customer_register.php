
<?php

$subject = 'Akun Customer Service Bandara SAMS Sepinggan Balikpapan';
include __DIR__.'\..\pesan/header.php';
$text = '<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Aktivasi Akun Customer Service Bandara SAMS Sepinggan Balikpapan</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <div align="left">
    Data anda sudah kami terima, mohon menunggu proses konfirmasi. Setelah konfirmasi selesai, anda akan diberitahu melalui Email dalam kurun waktu 1x24 jam(hari kerja)<br>
    apabila dalam kurun waktu 1 x 24 jam tidak mendapat email notifikasi , silahkan melakukan pendaftaran ulang pada link berikut <a href="'.$link.'register">Klik di sini</a> 
    atau hubungi Admin Customer Service pada email berikut nawang.ayunanda@ap1.co.id  atau theodora.Davita@ap1.co.id
  </div>
</div>
</body>
</html>';
$mail->msgHTML($text, __DIR__);
$mail->addAddress($to, $nama);
if (!$mail->send()) {
    $berhasil = false;
} else {
    $berhasil = true;
}
?>