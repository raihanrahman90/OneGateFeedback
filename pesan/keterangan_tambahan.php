
<?php
$subject='Keterangan Tambahan';
    include '../pesan/header.php';
$text = '<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Aktifasi Akun Customer Service</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <div align="left">
    Kami membutuhkan keterangan lebih lanjut untuk menindak lanjuti feedback anda dengan nomor antrian '.$id_aduan.', silahkan mengisi keterangan tambahan pada link berikut<br>
    <a href="'.$link.'customer/tampil_antri.php?id='.$id_aduan.'">Klik Disini</a>
  </div>
</div>
</body>
</html>';
$query = mysqli_query($koneksi, "SELECT token from tb_customer inner join tb_token on tb_customer.id_customer = tb_token.id where email='".$email."' and tb_token.status='customer'") or die(mysqli_error($koneksi));
if($result = mysqli_fetch_array($query)){
    sendPushNotification(
        $result['token'], 
        "Keterangan tambahan", 
        "Customer service membutuhkan keterangan lebih lanjut untuk menindak lanjuti aduan anda",
        '/customer/customer-keterangan-tambahan/'.$id_aduan,
        '',
        '');
}
$mail->msgHTML($text, __DIR__);
    $mail->addAddress($email, $nama);
    if (!$mail->send()) {
        $kirim = false;
    } else {
        $kirim = true;
    }
?>