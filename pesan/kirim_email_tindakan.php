
<?php
    include __DIR__.'\..\pesan/header.php';
    $text = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Terdapat Tindakan baru</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Tindakan baru telah dilakukan pada id aduan '.$id_aduan.'.Silahkan buka tautan berikut<br>
        <a href="'.$link.'Admin/detail_aduan.php?id='.$id_aduan.'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
$mail->msgHTML($text, __DIR__);
//Attach an image file
//send the message, check for errors
$data = mysqli_query($koneksi, "SELECT token, Email, Nama FROM tb_akun 
left join (SELECT * from tb_token where status='akun') as tb_token on tb_token.id = tb_akun.id_akun where (hak_akses ='Admin2' or hak_akses='Super Admin')");
foreach ($data as $row) {
  if(!is_null($row['token'])){
    sendPushNotification(
        $row['token'], 
        "Tindakan Baru", 
        "Tindakan baru telah dilakukan pada aduan dengan id ".$id_aduan,
        "/side/aduan-list/aduan-detail/".$id_aduan,
        '','');
  }
    $mail->addAddress($row['Email'], $row['Nama']);
    $mail->send();
}
?>