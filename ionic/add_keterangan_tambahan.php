<?php
    include '../koneksi.php';
    $pertanyaan = $koneksi->real_escape_string($_POST['pertanyaan']);
    $id = $koneksi -> real_escape_string($_POST['id_aduan']);
    $nama = $koneksi -> real_escape_string($_POST['nama']);
    $id_akun = $_POST['id_akun'];
    $id_aduan = $id;
    $query= mysqli_query($koneksi, "INSERT INTO tb_keterangan_tambahan VALUES(0, '$id','$id_akun', '$pertanyaan oleh $nama', NULL,NULL, NULL)") or die(mysqli_error($koneksi));
    $id_keterangan =mysqli_insert_id($koneksi);
    $id_link = md5($id_keterangan);
    $update = mysqli_query($koneksi, "UPDATE tb_keterangan_tambahan SET link = '$id_link' where id_keterangan='$id_keterangan'") or die(mysqli_error($koneksi));
    $query1 = mysqli_query($koneksi, "SELECT email, nama from tb_customer 
    inner join tb_aduan on tb_aduan.id_customer = tb_customer.id_customer where id_aduan = $id") or die(mysqli_error($koneksi));
    if($query1){
        $data = mysqli_fetch_array($query1);
        $email = $data['email'];
        $nama = $data['nama'];
        $subject ='Keterangan Tambahan';
        include '../pesan/keterangan_tambahan.php';
    }
    $result = json_encode(array('success'=>true));
    echo $result;
?>