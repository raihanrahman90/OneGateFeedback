<?php
    include 'header.php';
    if(isset($TOKEN)){
        if($TOKEN['hak_akses']=='Admin1' || $TOKEN['hak_akses']=='Super Admin'){
            $data = array();
            $id_aduan = $_GET['id_aduan'];
            $query=mysqli_query($koneksi, "SELECT * from tb_keterangan_tambahan where id_aduan='$id_aduan'") or die(mysqli_error($koneksi));
            while($row = mysqli_fetch_array($query)){
                $data[] = array(
                    'id_keterangan' => $row['id_keterangan'],
                    'pertanyaan' => $row['pertanyaan'],
                    'jawaban'=>$row['jawaban'],
                    'bukti'=>$row['bukti']
                );
            }
            if($query) $result=json_encode(array('success'=>true, 'result'=>$data));
            else $result=json_encode(array('success'=>false));
        }else{
            $result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
        }
    }else{
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
    }
    echo $result;
?>