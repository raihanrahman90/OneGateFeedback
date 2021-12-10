
<?php
    $subject = 'Feedback Terhadap Unit Anda';
    include __DIR__.'\..\pesan/header.php';
    $text = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <title>Terdapat Keluhan Baru Terhadap Unit Anda</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Feedback baru telah dikirim oleh Customer Service dengan id aduan '.$id_aduan.'. Silahkan buka tautan berikut<br>
        <a href="'.$link.'Admin/detail_aduan.php?id='.$id_aduan.'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
    $mail->msgHTML($text, __DIR__);
    $data = mysqli_query($koneksi, "SELECT tb_token.token, Email, Nama FROM tb_akun 
                                    left join (SELECT * from tb_token where status='akun') as tb_token on tb_akun.id_akun = tb_token.id where id_unit ='$id_unit'") or die(mysqli_error($koneksi));
    while($row = mysqli_fetch_array($data)) {
        sendPushNotification(
            $row['token'], 
            'Feedback Baru Terhadap Unit Anda', 
            'Feedback Baru Terhadap Unit Anda',
            'admin',
            'aduan',
            $id_aduan);
        $mail->addAddress($row['Email'], $row['Nama']);
    }
    $mail->send();


?>