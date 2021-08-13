<?php
    include 'header.php';
    if(isset($TOKEN)){
        if($TOKEN['hak_akses']=='Admin1' || $TOKEN['hak_akses']=='Super Admin'){
            $query = mysqli_query($koneksi, "SELECT *, tb_aduan.status as status_aduan from tb_aduan 
                                        left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
                                        WHERE (tb_aduan.status = 'Request' or tb_aduan.status='Returned') 
                                        and level>-1 
                                        ORDER BY waktu ASC") or die(mysqli_error($koneksi));
            $result = array();
            while($row = mysqli_fetch_array($query)){
                $result[] = array(
                    'id_aduan' => $row['id_aduan'],
                    'perihal' => $row['perihal'],
                    'status'=>$row['status_aduan'],
                    'waktu' => $row['waktu'],
                    'nama_perusahaan'=>$row['nama_perusahaan'],
                    'urgensi'=>$row['urgensi']
                );
            }
            $result = json_encode(array('success'=>true, 'result'=>$result));
        }else{
            $result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
        }
    }else{
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
    }
    echo $result;
?>