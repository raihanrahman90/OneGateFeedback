<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';
// menangkap data yang dikirim dari form
$tindakan = $koneksi -> real_escape_string($_POST['tindakan']);
$status = $koneksi -> real_escape_string($_POST['status']);
$id_aduan = $_POST['id_aduan'];
if($status == 'Complete' && !is_uploaded_file($_FILES['Bukti']['tmp_name'])){
    /**Status Complete Tanpa menyertakan bukti gambar */
    $TOKEN['status_jalan']='Gambar is missing';
    header('Location:../Admin/tindakan.php?id='.$id_aduan);
    /**Status Complete Tanpa menyertakan bukti gambar */
}else{
    /**Status Complete menyertakan bukti gambar */
    if($status =='Complete'){
        $tindakan = "Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ".$tindakan;
    }else if($status=='Progress'){
        $tindakan = "Feedback direspons oleh unit dengan keterangan ".$tindakan;
    }
    $id_akun = $TOKEN['id_akun'];
    // menyeleksi data admin dengan username dan password yang sesuai
    $data = mysqli_query($koneksi,"INSERT INTO tb_progress VALUES(0,$id_akun,$id_aduan, '$tindakan',NULL,now())") or die(mysqli_error($koneksi));
    $id = mysqli_insert_id($koneksi);
    $la = mysqli_query($koneksi,"UPDATE tb_aduan set status='$status' WHERE id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    if(is_uploaded_file($_FILES['Bukti']['tmp_name'])){
        $nama = $_FILES['Bukti']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $tipe_file = $_FILES['Bukti']['type'];
        $tmp_file = $_FILES['Bukti']['tmp_name'];
        $id1 = $id.".".$ekstensi;
        // menghitung jumlah data yang ditemukan
        $cek = mysqli_query($koneksi,"UPDATE tb_progress SET bukti='$id1' WHERE id_progress = '$id'") or die(mysqli_error($koneksi));
        move_uploaded_file($tmp_file, "../gambar/bukti/".$id1);
    }
    if(is_uploaded_file($_FILES['laporan']['tmp_name'])){
        $tmp_laporan = $_FILES['laporan']['tmp_name'];
        $namaLaporan = $id.'.pdf';
        move_uploaded_file($tmp_laporan, "../gambar/bukti/".$namaLaporan);
    }
    if($status='Complete'){
        $subject = 'Satu keluhan telah diselesaikan';
        include '../pesan/kirim_email_selesai.php';
    }
    header("Location:../Admin");
    /**Status Complete menyertakan bukti gambar */	
}
?>