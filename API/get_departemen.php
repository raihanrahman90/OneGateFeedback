<?php
    include 'header.php';
    if(isset($TOKEN)){
        if($TOKEN['hak_akses']=='Admin1' || $TOKEN['hak_akses']=='Super Admin'){
            $data=array();
            $query=mysqli_query($koneksi, "SELECT tb_departemen.id_departemen,tb_departemen.Departemen, count(id_unit) as jumlah from tb_departemen
            left join tb_unit on tb_departemen.id_departemen = tb_unit.id_departemen 
            group by tb_departemen.id_departemen") or die(mysqli_error($koneksi));
            while($row = mysqli_fetch_array($query)){
                $data[] = array(
                    'id_departemen' => $row['id_departemen'],
                    'nama_departemen' => $row['Departemen'],
                    'jumlah'=>$row['jumlah']
                    
                );
            }
            if($query) $result=json_encode(array('success'=>true, 'result'=>$data));
            else $result = json_encode(array('success'=>false));
        }else{
            $result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
        }
    }else{
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
    }
    echo $result;
?>