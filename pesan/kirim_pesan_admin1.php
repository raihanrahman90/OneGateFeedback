
<?php
$subject = 'Feedback Baru telah dikirimkan';
    include_once __DIR__.'\..\pesan\header.php';
    $text = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Feedback baru telah dikirim</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Feedback baru telah masuk dengan nomor aduan '.$id.'<br>
        Silahkan periksa pada tautan berikut <a href="'.$link.'Admin/detail_request.php?id='.$id.'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
$mail->msgHTML($text, __DIR__);
//Replace the plain text body with one created manually
//Attach an image file
//send the message, check for errors
$data = mysqli_query($koneksi, "SELECT tb_token.token, Email, Nama FROM tb_akun 
left join (SELECT * from tb_token where status='akun') as tb_token on tb_akun.id_akun = tb_token.id where hak_akses ='Admin1' or hak_akses='Super Admin'");
while($row = mysqli_fetch_array($data)) {
    if(!is_null($row['token'])){
      sendPushNotification(
        $row['token'], 
        "Feedback baru telah dikirim", 
        "Feedback baru telah dikirim",
        'admin',
        'request',
        $id_aduan);
    }
    $mail->addAddress($row['Email'], $row['Nama']);
}
$mail->send();
?>