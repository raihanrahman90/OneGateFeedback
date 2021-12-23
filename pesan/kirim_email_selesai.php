
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
        Keluhan dengan id '.$id_aduan.' telah selesai ditindak. Silahkan buka tautan berikut<br>
        <a href="'.$link.'Admin/detail_aduan.php?id='.$id_aduan.'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
$mail->msgHTML($text, __DIR__);
//Replace the plain text body with one created manually
//Attach an image file
//send the message, check for errors
$data = mysqli_query($koneksi, "SELECT tb_token.token, Email, Nama FROM tb_akun 
left join (SELECT * from tb_token where status='akun') as tb_token on tb_akun.id_akun = tb_token.id where hak_akses ='Admin2' or hak_akses='Super Admin'");
while($row = mysqli_fetch_array($data)) {
    if(!is_null($row['token'])){
      sendPushNotification(
        $row['token'], 
        "Tindakan selesai", 
        "Keluhan dengan id ".$id_aduan." selesai ditindak",
        'admin',
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
  
  $mail->Subject = "Feedback Anda Telah Selesai Ditindak";
  $text = '<!DOCTYPE html>
  <html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Feedback Telah Selesai Ditindak</title>
  </head>
  <body>
  <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <div align="left">
  Keluhan dengan id '.$id_aduan.' telah selesai ditindak. Silahkan buka tautan berikut<br>
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
      'Feedback anda telah selesai ditindak', 
      'Feedback Anda telah selesai ditindak',
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