<?php 
include __DIR__.'\..\koneksi.php';
$subject = 'Akun Customer Service';
include __DIR__.'\..\pesan/header.php';
$cek_status = mysqli_query($koneksi, "SELECT * FROM tb_customer 
 where TIMESTAMPDIFF(DAY, masa_berlaku,now()) >= 0 and status='1'");
while($row = mysqli_fetch_array($cek_status)){
 $text_level4 = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <title>Penonaktifan Akun</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Masa berlaku akun layanan customer service Bandara SAMS Sepinggan Balikpapan anda telah berakhir, silahkan konfirmasi pada link berikut untuk pengaktifan kembali<br>
        <a href="'.$link.'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
    $mail->msgHTML($text_level4, __DIR__);
        $mail->addAddress($row['email'], $row['nama']);
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
}

mysqli_query($koneksi,"UPDATE tb_customer set status=2 where TIMESTAMPDIFF(DAY, masa_berlaku,now()) >= 0 and status='1'") or die(mysqli_error($koneksi));
$mail->Subject = 'Akun Customer Service Bandara SAMS Sepinggan Balikpapan';
$cek_notif = mysqli_query($koneksi, "SELECT email FROM tb_notif where waktu<now()") or die(mysqli_error($koneksi));
while($row = mysqli_fetch_array($cek_notif)){
    $email = $row['email'];
    $text_level4 = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <title>Penonaktifan Akun</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
       Akun customer service anda belum diaktivasi oleh Admin Customer Service, silahkan lakukan pendaftaran ulang pada link berikut<br>
        <a href="'.$link.'register">Klik Disini</a><br>
        Atau hubungi customer service pada email berikut<br>
        nawang.ayunanda@ap1.co.id<br>
        Theodora.Davita@ap1.co.id
      </div>
    </div>
    </body>
    </html>';
    mysqli_query($koneksi, "DELETE FROM tb_notif where email='$email'") or die(mysqli_error($koneksi));
    $mail->msgHTML($text_level4, __DIR__);
        $mail->addAddress($row['email'], '');
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
}
?>