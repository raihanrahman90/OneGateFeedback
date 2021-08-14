<?php 
    include 'header.php';
    if(isset($TOKEN['hak_akses'])){
        if($TOKEN['hak_akses']=='Super Admin'){
            $id_lokasi = $koneksi -> real_escape_string($_GET['id_lokasi']);
            $nama_lokasi = $koneksi -> real_escape_string($_POST['nama_lokasi']);
            $query = mysqli_query($koneksi, "UPDATE tb_lokasi SET nama_lokasi='$nama_lokasi' where id_lokasi='$id_lokasi'");
            if($query){
                $result= json_encode(array('success'=>true));
            }else{
                $result= json_encode(array('success'=>false,'message'=>'Terjadi kesalahan'));
            }
        }
    }else{
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
    }
    echo $result;
?>