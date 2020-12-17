<?php
	include 'header.php';// menangkap data yang dikirim dari form
    
    $id_keterangan_tambahan = $koneksi -> real_escape_string($_POST['id_keterangan_tambahan']);
    $jawaban = $koneksi -> real_escape_string(htmlspecialchars($_POST['jawaban']));

    $update = mysqli_query($koneksi, "UPDATE tb_keterangan_tambahan SET jawaban='$jawaban' WHERE id_keterangan='$id_keterangan_tambahan'") or die(mysqli_error($koneksi));
    $data = mysqli_query($koneksi, "SELECT * FROM tb_keterangan_tambahan 
    INNER JOIN tb_akun on tb_akun.id_akun = tb_keterangan_tambahan.id_akun
    where id_keterangan= '$id_keterangan_tambahan'") or die(mysqli_error($koneksi));
    $data = mysqli_fetch_array($data);
    $email = $data['Email'];
    $nama = $data['Nama'];
    $id_aduan = $data['id_aduan'];
    if(isset($_FILES['bukti'])){
        $nama_foto = $id_aduan.'.jpg';
        mysqli_query($koneksi, "UPDATE tb_keterangan_tambahan SET bukti='$nama_foto' WHERE id_keterangan ='$id_keterangan_tambahan'") or die(mysqli_error($koneksi));
    	move_uploaded_file($_FILES['bukti']['tmp_name'], "../gambar/keterangan_tambahan/".$nama_foto);
    }
    $subject = 'Keterangan Tambahan';
    include "../pesan/add_jawaban.php";
    if($update) $result = json_encode(array('success'=>true));
    else $result = json_encode(array('success'=>false));
    echo $result;
?>