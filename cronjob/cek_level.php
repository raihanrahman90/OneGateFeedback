<?php 
include __DIR__.'\..\koneksi.php';
$subject = 'Keluhan naik level';
include __DIR__.'\..\pesan\header.php';
function getPesan($level, $id, $link){
    ///fungsi untuk setting pesan
    $text = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Feedback memasuki level '.$level.'</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Feedback dengan nomor aduan '.$id.' telah memasuk Level '.$level.'<br>
        Silahkan pantau pada tautan berikut <a href="'.$link.'Admin/detail_aduan.php?id='.$id.'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
    return $text;
}

$level0 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
where TIMESTAMPDIFF(MINUTE, waktu,now()) >= 30 and level=-1");

while($row = mysqli_fetch_array($level2)){
    $id_aduan = $row['id_aduan'];
    $text = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Feedback memasuki level '.$level.'</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Feedback baru telah masuk dengan nomor aduan '.$id_aduan.'<br>
        Silahkan periksa pada tautan berikut <a href="'.$link.'Admin/detail_request.php?id='.$id_aduan.'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
    $email = mysqli_query($koneksi, "SELECT token, Email, tb_akun.nama as nama from tb_akun 
                                    left join (SELECT * from tb_token where status='akun') as tb_token on tb_token.id = tb_akun.id_akun 
                                    where tb_akun.status='Admin1'") or die(mysqli_error($koneksi));
    $mail->msgHTML($text, __DIR__);
    $mail->ClearAllRecipients();
    while($list_email = mysqli_fetch_array($email)){
        if(!is_null($list_email['token'])){
            sendPushNotification(
              $list_email['token'], 
              "Feedback baru telah diterima", 
              "Feedback baru telah dikirim oleh customer", 
              '/side/request-list/request-detail/'.$id_aduan,
              '',
              ''
            );
        }
        $mail->addAddress($list_email['Email'], $list_email['nama']);
    }
    if(!$mail->send()){
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}
$level1 = mysqli_query($koneksi, "UPDATE tb_aduan set level=0 where TIMESTAMPDIFF(MINUTE, waktu,now()) >= 30 and level=-1") or die(mysqli_error($koneksi));

///level2

$level2 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
inner join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen WHERE 
TIMESTAMPDIFF(DAY, waktu,now()) >= 1 and status='Open' and level = 1 and urgensi !=1");

while($row = mysqli_fetch_array($level2)){
    $id_aduan = $row['id_aduan'];
    $text_level2 = getPesan('2', $id_aduan, $link);
    $email = mysqli_query($koneksi, "SELECT token, Email, tb_akun.nama as nama from tb_akun 
                                    left join (SELECT * from tb_token where status='akun') as tb_token on tb_token.id = tb_akun.id_akun 
                                    where id_unit = '".$row['id_unit']."' or (id_departemen ='".$row['id_departemen']."' and tb_akun.status='Senior Manager')") or die(mysqli_error($koneksi));
    $mail->msgHTML($text_level2, __DIR__);
    $mail->ClearAllRecipients();
    while($list_email = mysqli_fetch_array($email)){
        if(!is_null($list_email['token'])){
            sendPushNotification(
              $list_email['token'], 
              "Keterangan Tambahan", 
              "Keterangan tambahan telah ditambahkan pada aduan dengan id ".$id_aduan, 
              '/side/request-list/request-detail/'.$id_aduan,
              '',
              ''
            );
        }
        $mail->addAddress($list_email['Email'], $list_email['nama']);
    }
    if(!$mail->send()){
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}
mysqli_query($koneksi,"UPDATE tb_aduan set level=2 where TIMESTAMPDIFF(DAY, waktu,now()) >= 1 and status='Open' and level = 1 and urgensi !=1") or die(mysqli_error($koneksi));


///level 3

$level3 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
inner join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen 
WHERE TIMESTAMPDIFF(DAY, waktu,now()) >= 2 and status='Open' and level = 2 and urgensi !=1");

while($row = mysqli_fetch_array($level3)){
    $id_aduan = $row['id_aduan'];
    $text_level3 = getPesan('3', $id_aduan, $link);
    $email = mysqli_query($koneksi, "SELECT token,Email, tb_akun.nama as nama from tb_akun
                                    left join (SELECT * from tb_token where status='akun') as tb_token on tb_token.id = tb_akun.id_akun 
                                    where id_unit = '".$row['id_unit']."' or 
                                    (id_departemen ='".$row['id_departemen']."' and tb_akun.status='Senior Manager') or
                                    tb_akun.status='AOC Head'") or die(mysqli_error($koneksi));
    $mail->msgHTML($text_level3, __DIR__);
    $mail->ClearAllRecipients();
    while($list_email = mysqli_fetch_array($email)){
        if(!is_null($list_email['token'])){
            sendPushNotification(
              $list_email['token'], 
              "Keterangan Tambahan", 
              "Keterangan tambahan telah ditambahkan pada aduan dengan id ".$id_aduan, 
              '/side/request-list/request-detail/'.$id_aduan,
              '',
              ''
            );
        }
        $mail->addAddress($list_email['Email'], $list_email['nama']);
    }
    if(!$mail->send()){
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}

mysqli_query($koneksi,"UPDATE tb_aduan set level=3 where TIMESTAMPDIFF(DAY, waktu,now()) >= 2 and status='Open' and level = 2 and urgensi !=1") or die(mysqli_error($koneksi));

///level 4
$level4 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
inner join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen 
WHERE TIMESTAMPDIFF(DAY, waktu,now()) >= 3 and status='Open' and level = 3 and urgensi !=1");

while($row = mysqli_fetch_array($level4)){
    $id_aduan = $row['id_aduan'];
    $text_level4 = getPesan('4', $id_aduan, $link);
    $mail->msgHTML($text_level4, __DIR__);
    $mail->ClearAllRecipients();
    $email = mysqli_query($koneksi, "SELECT token,Email, tb_akun.nama as nama from tb_akun
                                    left join (SELECT * from tb_token where status='akun') as tb_token on tb_token.id = tb_akun.id_akun 
                                    where id_unit = '".$row['id_unit']."' or 
                                    (id_departemen ='".$row['id_departemen']."' and tb_akun.status='Senior Manager') or
                                    tb_akun.status='AOC Head' or tb_akun.status='General Manager'") or die(mysqli_error($koneksi));
    while($list_email = mysqli_fetch_array($email)){
        if(!is_null($list_email['token'])){
            sendPushNotification(
              $list_email['token'], 
              "Keterangan Tambahan", 
              "Keterangan tambahan telah ditambahkan pada aduan dengan id ".$id_aduan, 
              '/side/request-list/request-detail/'.$id_aduan,
              '',
              ''
            );
        }
        $mail->addAddress($list_email['Email'], $list_email['nama']);
    }
    if(!$mail->send()){
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}

mysqli_query($koneksi,"UPDATE tb_aduan set level=4 where TIMESTAMPDIFF(DAY, waktu,now()) >= 3 and status='Open' and level = 3 and urgensi !=1") or die(mysqli_error($koneksi));
///batas tidak urgen
///mulai urgen

$mail->Subject = 'Keluhan Urgent telah naik level';
///level2 urgen

$level2 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
inner join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen WHERE 
TIMESTAMPDIFF(HOUR, waktu,now()) >= 6 and status='Open' and level = 1 and urgensi =1");

while($row = mysqli_fetch_array($level2)){
    $id_aduan = $row['id_aduan'];
    $text_level2 = getPesan('2', $id_aduan, $link);
    $email = mysqli_query($koneksi, "SELECT token, Email, tb_akun.nama as nama from tb_akun 
                                    left join (SELECT * from tb_token where status='akun') as tb_token on tb_token.id = tb_akun.id_akun 
                                    where id_unit = '".$row['id_unit']."' or (id_departemen ='".$row['id_departemen']."' and tb_akun.status='Senior Manager')") or die(mysqli_error($koneksi));
    $mail->msgHTML($text_level2, __DIR__);
    $mail->ClearAllRecipients();
    while($list_email = mysqli_fetch_array($email)){
        if(!is_null($list_email['token'])){
            sendPushNotification(
              $list_email['token'], 
              "Keterangan Tambahan", 
              "Keterangan tambahan telah ditambahkan pada aduan dengan id ".$id_aduan, 
              '/side/request-list/request-detail/'.$id_aduan,
              '',
              ''
            );
        }
        $mail->addAddress($list_email['Email'], $list_email['nama']);
    }
    if(!$mail->send()){
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}
mysqli_query($koneksi,"UPDATE tb_aduan set level=2 where TIMESTAMPDIFF(HOUR, waktu,now()) >= 6 and status='Open' and level = 1 and urgensi =1") or die(mysqli_error($koneksi));


///level 3 urgen

$level3 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
inner join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen 
WHERE TIMESTAMPDIFF(HOUR, waktu,now()) >= 12 and status='Open' and level = 2 and urgensi =1");

while($row = mysqli_fetch_array($level3)){
    $id_aduan = $row['id_aduan'];
    $text_level3 = getPesan('3', $id_aduan, $link);
    $email = mysqli_query($koneksi, "SELECT token,Email, tb_akun.nama as nama from tb_akun
                                    left join (SELECT * from tb_token where status='akun') as tb_token on tb_token.id = tb_akun.id_akun 
                                    where id_unit = '".$row['id_unit']."' or 
                                    (id_departemen ='".$row['id_departemen']."' and tb_akun.status='Senior Manager') or
                                    tb_akun.status='AOC Head'") or die(mysqli_error($koneksi));
    $mail->msgHTML($text_level3, __DIR__);
    $mail->ClearAllRecipients();
    while($list_email = mysqli_fetch_array($email)){
        if(!is_null($list_email['token'])){
            sendPushNotification(
              $list_email['token'], 
              "Keterangan Tambahan", 
              "Keterangan tambahan telah ditambahkan pada aduan dengan id ".$id_aduan, 
              '/side/request-list/request-detail/'.$id_aduan,
              '',
              ''
            );
        }
        $mail->addAddress($list_email['Email'], $list_email['nama']);
    }
    if(!$mail->send()){
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}

mysqli_query($koneksi,"UPDATE tb_aduan set level=3 where TIMESTAMPDIFF(HOUR, waktu,now()) >= 12 and status='Open' and level = 2 and urgensi =1") or die(mysqli_error($koneksi));

///level 4 urgen
$level4 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
inner join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen 
WHERE TIMESTAMPDIFF(HOUR, waktu,now()) >= 18 and status='Open' and level = 3 and urgensi =1");

while($row = mysqli_fetch_array($level4)){
    $id_aduan = $row['id_aduan'];
    $text_level4 = getPesan('4', $id_aduan, $link);
    $mail->msgHTML($text_level4, __DIR__);
    $mail->ClearAllRecipients();
    $email = mysqli_query($koneksi, "SELECT token,Email, tb_akun.nama as nama from tb_akun
                                    left join (SELECT * from tb_token where status='akun') as tb_token on tb_token.id = tb_akun.id_akun 
                                    where id_unit = '".$row['id_unit']."' or 
                                    (id_departemen ='".$row['id_departemen']."' and tb_akun.status='Senior Manager') or
                                    tb_akun.status='AOC Head' or tb_akun.status='General Manager'") or die(mysqli_error($koneksi));
    while($list_email = mysqli_fetch_array($email)){
        if(!is_null($list_email['token'])){
            sendPushNotification(
              $list_email['token'], 
              "Keterangan Tambahan", 
              "Keterangan tambahan telah ditambahkan pada aduan dengan id ".$id_aduan, 
              '/side/request-list/request-detail/'.$id_aduan,
              '',
              ''
            );
        }
        $mail->addAddress($list_email['Email'], $list_email['nama']);
    }
    if(!$mail->send()){
        echo 'Mailer Error: '. $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}

mysqli_query($koneksi,"UPDATE tb_aduan set level=4 where TIMESTAMPDIFF(HOUR, waktu,now()) >= 18 and status='Open' and level = 3 and urgensi =1") or die(mysqli_error($koneksi));


?>