
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



  $getCustomer = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
        inner join tb_customer on tb_aduan.id_customer = tb_customer.id_customer
        where id_aduan='$id_aduan'");
  if($customer = mysqli_fetch_array($getCustomer)){
    $mail->Subject = "Feedback Telah Diteruskan kepada unit teknis";
    $text = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Feedback Telah Diteruskan kepada unit teknis</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
    <div align="left">
    Keluhan dengan id '.$id_aduan.' telah dikirimkan ke unit terkait. Silahkan buka tautan berikut untuk melihat progres<br>
    <a href="'.$link.'customer/tampil_antri.php?id='.$id_aduan.'">Klik Disini</a>
    </div>
    </div>
    </body>
    </html>';
    $email = $customer['email'];
    $query = mysqli_query($koneksi, "SELECT token from tb_customer inner join tb_token on tb_customer.id_customer = tb_token.id where email='$email'");
    if($result = mysqli_fetch_array($query)){
    sendPushNotification(
    $result['token'], 
    'Feedback telah diteruskan ke unit terkait', 
    'Feedback telah diteruskan ke unit terkait',
    'kustomer',
    'keterangan_tambahan',
    $id_aduan
    );
    }
    $mail->msgHTML($text, __DIR__);
    $mail->clearAllRecipients( );
    $mail->addAddress($email, $nama);
    if (!$mail->send()) {
      $kirim = false;
    } else {
      $kirim = true;
    }
  }
?>