
<?php
$subject ='Jawaban telah diberikan';
include '../pesan/header.php';
$text = '<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Aktifasi Akun Customer Service</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <div align="left">
   Keterangan tambahan telah diberikan untuk feedback dengan nomor antrian '.$id_aduan.' pada link berikut <a href="'.$link.'Admin/detail_request.php?id='.$id_aduan.'">Klik di sini</a>
  </div>
</div>
</body>
</html>';
//Attach an image file
//send the message, check for errors
$mail->msgHTML($text, __DIR__);
$data = mysqli_query($koneksi, "SELECT token, Email, Nama FROM tb_akun inner join tb_token on tb_token.id = tb_akun.id_akun where (hak_akses ='Admin2' or hak_akses='Super Admin') and tb_token.status='akun'");
foreach ($data as $row) {
    sendPushNotification(
        $row['token'], 
        "Keterangan Tambahan", 
        "Keterangan tambahan telah ditambahkan pada aduan dengan id ".$id_aduan, 
        '/side/request-list/request-detail/'.$id_aduan,
        '',
        ''
    );
    $mail->addAddress($row['Email'], $row['Nama']);
    $mail->send();
}
?>