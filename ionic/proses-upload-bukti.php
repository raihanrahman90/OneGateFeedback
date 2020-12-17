<?php
	include 'header.php';// menangkap data yang dikirim dari form
    $tindakan = $koneksi -> real_escape_string($_POST['tindakan']);
    $status = $koneksi -> real_escape_string($_POST['status']);
    $id_aduan = $_POST['id_aduan'];
    $id_akun = $_POST['id_akun'];
    $nama = $_FILES['Bukti']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $tipe_file = $_FILES['Bukti']['type'];
    $tmp_file = $_FILES['Bukti']['tmp_name'];
    // menyeleksi data admin dengan username dan password yang sesuai
    $data = mysqli_query($koneksi,"INSERT INTO tb_progress VALUES(0,$id_akun, $id_aduan,'$tindakan','a',now())") or die(mysqli_error($koneksi));
    $id = mysqli_insert_id($koneksi);
    $id1 = $id.".".$ekstensi;
    // menghitung jumlah data yang ditemukan
    $cek = mysqli_query($koneksi,"UPDATE tb_progress SET bukti='$id1' WHERE id_progress = '$id'") or die(mysqli_error($koneksi));
    $la = mysqli_query($koneksi,"UPDATE tb_aduan set status='$status' WHERE id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
    if(move_uploaded_file($tmp_file, "../gambar/bukti/".$id1)){
            $subject = 'Tindakan dilakukan';
            include "../pesan/kirim_email_selesai.php";
        echo json_encode(array('success'=>true));
    } else {
        echo json_encode(array('success'=>false, 'msg'=>'Gagal mengupload file'));
    }
    
/*$target_path = "../gambar/bukti";
 
$target_path = $target_path . basename( $_FILES['file']['name']);
 
if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    header('Content-type: application/json');
    $data = ['success' => true, 'message' => 'Upload and move success'];
    echo json_encode( $data );
} else{
    header('Content-type: application/json');
    $data = ['success' => false, 'message' => 'There was an error uploading the file, please try again!'];
    echo json_encode( $data );
}*/
 
?>