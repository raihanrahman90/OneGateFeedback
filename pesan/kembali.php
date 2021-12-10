
<?php
$subject = 'Feedback Bandara SAMS Sepinggan Balikpapan';
    include __DIR__.'\..\pesan\header.php';
    $text = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Terdapat Tindakan baru</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Aduan dengan id '.$id.' telah dikembalikan pada Customer Service oleh unit terkait<br>
        <a href="'.$link.'/Admin/detail_aduan.php?id='.$id_aduan.'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
$mail->msgHTML($text, __DIR__);
//Replace the plain text body with one created manually
//Attach an image file
//send the message, check for errors
$data = mysqli_query($koneksi, "SELECT token, Email, Nama FROM tb_akun inner join tb_token on tb_akun.id_akun = tb_token.id where (hak_akses ='Admin1' or hak_akses='Super Admin') and tb_token.status = 'akun'");
while($row = mysqli_fetch_array($data)) {
    sendPushNotification(
        $row['token'], 
        "Aduan Dikembalikan", 
        "Aduan dengan id ".$id_aduan." telah dikembalikan kepada customer service",
        'admin',
        'request',
        $id);
}
$data = mysqli_query($koneksi, "SELECT Email, Nama FROM tb_akun where (hak_akses ='Admin1' or hak_akses='Super Admin')");
while($row = mysqli_fetch_array($data)) {
  $mail->addAddress($row['Email'], $row['Nama']);
}
$mail->send();
?>