
<?php
include __DIR__.'\..\pesan/header.php';
$text = '<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Kasus Ditutup</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <div align="left">
    Customer Service Bandara SAMS Sepinggan Balikpapan telah menutup keluhan dengan nomor antrian '.$id_aduan.'<br>
    Silahkan beri penilaian atas layanan customer service kami pada link berikut
    <a href="'.$link.'customer/tampil_antri.php?id='.$id_aduan.'">Klik Disini</a>
  </div>
</div>
</body>
</html>';
$query = mysqli_query($koneksi, "SELECT token from tb_customer inner join tb_token on tb_customer.id_customer = tb_token.id where email='$email'");
if($result = mysqli_fetch_array($query)){
    sendPushNotification(
        $result['token'], 
        'Beri Penilaian terhadap Layanan dan Sistem kami', 
        'Customer Service telah menutup keluhan anda, silahkan berikan penilaian',
        'kustomer',
        'keterangan_tambahan',
        $id_aduan
    );
}
$mail->msgHTML($text, __DIR__);
    $mail->addAddress($email, $nama);
    if (!$mail->send()) {
        $kirim = false;
    } else {
        $kirim = true;
    }
?>