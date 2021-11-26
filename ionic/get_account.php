<?php
    require('header.php');
    $queryAkun = mysqli_query($koneksi, "SELECT * from tb_akun 
                                            left join tb_unit ON tb_akun.id_unit=tb_unit.id_unit 
                                            left join tb_departemen ON tb_akun.id_departemen = tb_departemen.id_departemen 
                                            ORDER BY tb_akun.id_unit") or die(mysqli_error($koneksi));
    $akun = array();
    foreach($queryAkun as $row){
        array_push(
            $akun,
            array(
                'id_akun'=>$row['Id_akun'],
                'hak_akses'=>$row['hak_akses'],
                'status'=>$row['status'],
                'departemen'=>$row['Departemen'],
                'unit'=>$row['nama_unit'],
                'nama'=>$row['nama']
            )
            );
    }
    echo json_encode(array('success'=>true, 'data'=>$akun));
?>