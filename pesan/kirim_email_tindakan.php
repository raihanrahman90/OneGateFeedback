
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
        "admin",
        'aduan',
        $id_aduan);
  }
    $mail->addAddress($row['Email'], $row['Nama']);
}
$mail->send();





$getCustomer = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
                                        inner join tb_customer on tb_aduan.id_customer = tb_customer.id_customer
                                        where id_aduan='$id_aduan'");
if($customer = mysqli_fetch_array($getCustomer)){
  
  $mail->Subject = "Telah Dilakukan Tindakan Terhadap Feedback Anda";
  $text = '<!DOCTYPE html>
  <html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Tindakan terhadap Feedback Anda</title>
  </head>
  <body>
  <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <div align="left">
  Keluhan dengan id '.$id_aduan.' telah dilakukan tindakan. Silahkan buka tautan berikut untuk melihat progres<br>
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
      'Telah dilakukan tindakan terhadap feedback Anda', 
      'Telah dilakukan tindakan terhadap feedback Anda',
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