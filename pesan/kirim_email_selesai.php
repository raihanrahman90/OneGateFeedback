
<?php
$subject = 'Feedback Bandara SAMS Sepinggan Balikpapan';
    include '../pesan/header.php';
    $text = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Terdapat Tindakan baru</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Tindakan baru telah dimasukkan. Silahkan buka tautan berikut<br>
        <a href="'.$link.'/Admin/detail_aduan.php?id='.$id_aduan.'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
$mail->msgHTML($text, __DIR__);
//Replace the plain text body with one created manually
//Attach an image file
//send the message, check for errors
$data = mysqli_query($koneksi, "SELECT token, Email, Nama FROM tb_akun inner join tb_token on tb_akun.id_akun = tb_token.id where (hak_akses ='Admin2' or hak_akses='Super Admin') and tb_token.status = 'akun'");
while($row = mysqli_fetch_array($data)) {
    sendPushNotification(
        $row['token'], 
        "Tindakan Baru", 
        "Tindakan baru telah dilakukan pada aduan dengan id ".$id_aduan,
        '/side/aduan-list/aduan-detail/'.$id_aduan,
        '',
        '');
    $mail->addAddress($row['Email'], $row['Nama']);
    $mail->send();
}
?>