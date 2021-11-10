
<?php
    include 'header.php';
    if(isset($TOKEN)){
        if($TOKEN['hak_akses']=='Admin1' || $TOKEN['hak_akses']=='Super Admin'){
            $data=array();
            $query = mysqli_query($koneksi, "SELECT * from tb_akun 
                                                    left join tb_unit ON tb_akun.id_unit=tb_unit.id_unit 
                                                    left join tb_departemen ON tb_akun.id_departemen = tb_departemen.id_departemen 
                                                    ORDER BY tb_akun.id_unit") or die(mysqli_error($koneksi));
            while($row = mysqli_fetch_array($query)){
                $data[] = array(
                    'id_akun' => $row['Id_akun'],
                    'nama' => $row['Nama'],
                    'nama_departemen'=>$row['Departemen'],
                    'nama_unit'=>$row['nama_unit'],
                    'status'=>$row['status']
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