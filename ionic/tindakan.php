<?php 

// menghubungkan dengan koneksi
include '../koneksi.php';
// menangkap data yang dikirim dari form
$tindakan = $koneksi -> real_escape_string($_POST['tindakan']);
$status = $koneksi -> real_escape_string($_POST['status']);
$id_aduan = $_POST['id_aduan'];
if($status == 'Complete' && !isset($_FILES['Bukti']['tmp_name'])){
    /**Status Complete Tanpa menyertakan bukti gambar */
	$result = json_encode(array('success'=>false, 'msg'=>'Mohon inputkan gambar untuk status complete'));
	echo $result;
    /**Status Complete Tanpa menyertakan bukti gambar */
}else{
    /**Status Complete menyertakan bukti gambar */
    if($status =='Complete'){
        $tindakan = "Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ".$tindakan;
    }else if($status=='Progress'){
        $tindakan = "Feedback direspons oleh unit dengan keterangan ".$tindakan;
    }
    $id_akun = $_SESSION['id_akun'];
    // menyeleksi data admin dengan username dan password yang sesuai
    $data = mysqli_query($koneksi,"INSERT INTO tb_progress VALUES(0,$id_akun,$id_aduan, '$tindakan',NULL,now())") or die(mysqli_error($koneksi));
    $id = mysqli_insert_id($koneksi);
    $la = mysqli_query($koneksi,"UPDATE tb_aduan set status='$status' WHERE id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    if(isset($_FILES['bukti']) &&is_uploaded_file($_FILES['Bukti']['tmp_name'])){
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
    if(isset($_FILES['bukti']) && is_uploaded_file($_FILES['laporan']['tmp_name'])){
        $tmp_laporan = $_FILES['laporan']['tmp_name'];
        $namaLaporan = $id.'.pdf';
        move_uploaded_file($tmp_laporan, "../gambar/bukti/".$namaLaporan);
    }
    if($status='Complete'){
        $subject = 'Satu keluhan telah diselesaikan';
        include '../pesan/kirim_email_selesai.php';
    }
	$result = json_encode(array('success'=>true));
	echo $result;
    /**Status Complete menyertakan bukti gambar */	
}
?>