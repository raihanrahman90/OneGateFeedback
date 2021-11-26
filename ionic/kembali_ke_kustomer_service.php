<?php
    include('../koneksi.php');
    $id = $koneksi-> real_escape_string($_POST['id_aduan']);
    $id_akun = $_POST['user_id_akun'];
    $keterangan = $koneksi-> real_escape_string($_POST['keterangan']);
    $penjelasan = $koneksi-> real_escape_string($_POST['penjelasan']);
    if($keterangan=='Kurang Data'){
        $keterangan = 'Unit kekurangan data, '.$penjelasan;
    }else{
        $keterangan = $keterangan. ', '.$penjelasan;
    }
    $data = mysqli_query($koneksi, "UPDATE tb_aduan SET  status ='Returned', id_unit=NULL, nama_departemen=NULL, nama_unit=NULL, level=0 WHERE id_aduan ='$id'") or die(mysqli_error($koneksi));
    $data1 = mysqli_query($koneksi, "INSERT INTO tb_progress VALUES(0,$id_akun,$id,'Dikembalikan ke cs dengan keterangan $keterangan',NULL,now())") or die(mysqli_error($koneksi));
    $id_aduan = $id;
    include('../pesan/kembali.php');
    $result = json_encode(array('success'=>true));
    echo $result;
?>