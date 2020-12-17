
<?php
$subject ="Token Ganti Password";
include '../pesan/header.php';
$text = '<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Kasus Ditutup</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
  <div align="left">
    Silahkan masukkan token ini pada tautan berikut untuk mengubah password anda<br>
    <table>
        <tr>
            <td>Token</td>
            <td>: '.$token.'</td>
        </tr>
        <tr>
            <td>Gunakan Sebelum</td>
            <td>: '.$end.'</td>
        </tr>
    </table>
    <a href="'.$link.'customer/kirim_token.php">Masukkan Token</a>
  </div>
</div>
</body>
</html>';
    $mail->msgHTML($text, __DIR__);
    $mail->addAddress($email, $nama);
    if (!$mail->send()) {
        $berhasil = false;
    } else {
        $berhasil = true;
    }
?>