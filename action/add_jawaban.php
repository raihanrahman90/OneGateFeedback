<?php
    session_start();
    include "../koneksi.php";
    $link = $koneksi -> real_escape_string($_POST['link']);
    $jawaban = $koneksi -> real_escape_string(htmlspecialchars($_POST['jawaban']));

    $update = mysqli_query($koneksi, "UPDATE tb_keterangan_tambahan SET jawaban='$jawaban' WHERE link='$link'") or die(mysqli_error($koneksi));
    $data = mysqli_query($koneksi, "SELECT * FROM tb_keterangan_tambahan 
                                    INNER JOIN tb_akun on tb_akun.id_akun = tb_keterangan_tambahan.id_akun
                                    where link= '$link'") or die(mysqli_error($koneksi));
    $data = mysqli_fetch_array($data);
    $email = $data['Email'];
    $nama = $data['Nama'];
    $id_keterangan = $data['id_keterangan'];
    $id_aduan = $data['id_aduan'];
    if(is_uploaded_file($_FILES['bukti']['tmp_name'])){
        $nama = $_FILES['bukti']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $tipe_file = $_FILES['bukti']['type'];
        $tmp_file = $_FILES['bukti']['tmp_name'];
        // menyeleksi data ke dalam tb_aduan
        $nama_foto = $id_keterangan.".".$ekstensi;
        mysqli_query($koneksi, "UPDATE tb_keterangan_tambahan SET bukti='$nama_foto' WHERE link ='$link'") or die(mysqli_error($koneksi));
    	move_uploaded_file($_FILES['bukti']['tmp_name'], "../gambar/keterangan_tambahan/".$nama_foto);
    }
    $subject = 'Keterangan Tambahan';
    include "../pesan/add_jawaban.php";
    header("Location:../customer/tampil_antri.php?id=".$id_aduan);
?>