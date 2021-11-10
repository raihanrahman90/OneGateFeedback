<?php
    include 'header.php';
    if(isset($TOKEN)){
        if($TOKEN['hak_akses']=='Admin1' || $TOKEN['hak_akses']=='Super Admin'){
            $data = array();
            $query=mysqli_query($koneksi, "SELECT * from tb_urgensi");
            while($row = mysqli_fetch_array($query)){
                $data[] = array(
                    'id_urgensi' => $row['id_urgensi'],
                    'perihal' => $row['perihal']
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