
<?php
    $subject = 'Feedback Telah Dikembalikan ke Unit Teknis';
    include __DIR__.'\..\pesan/header.php';
    $text = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Feedback Telah Dikembalikan ke Unit Teknis</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Feedback telah dikembalikan ke unit teknis oleh Customer Service dengan id aduan '.$id_aduan.'. Silahkan buka tautan berikut untuk melihat keterangan detail<br>
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
            'Feedback Telah Dikembalikan ke Unit Teknis', 
            'Feedback Telah Dikembalikan ke Unit Teknis',
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
      
      $mail->Subject = "Feedback Telah Dikembalikan ke Unit Teknis";
      $text = '<!DOCTYPE html>
        <html lang="en">
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <title>Feedback Telah Dikembalikan ke Unit Teknis</title>
        </head>
        <body>
        <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
          <div align="left">
            Feedback telah dikembalikan ke unit teknis oleh Customer Service dengan id aduan '.$id_aduan.'. Silahkan buka tautan berikut untuk melihat keterangan detail<br>
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
              'Feedback anda dikembalikan ke Unit Teknis', 
              'Feedback Anda telah dikembalikan ke Unit Teknis',
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