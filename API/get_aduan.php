<?php 
    include 'header.php';
    $d2 = new DateTime();
    if((
            $TOKEN['hak_akses']=='Super Admin' || $TOKEN['hak_akses'] == 'Admin2' || 
            $TOKEN['hak_akses']=='Pengawas Internal' || $TOKEN['hak_akses']=='Admin1'
        ) 
        || ($TOKEN['status_akun']=='AOC Head' || $TOKEN['status_akun']=='General Manager')
    ){
        $sintax = "SELECT tb_aduan.id_aduan, jenis, Departemen, tb_aduan.nama_unit, urgensi, perihal, status, level, 
            progress.id_aduan as merah, tb_aduan.waktu from tb_aduan 
            left join tb_unit ON tb_aduan.id_unit=tb_unit.id_unit 
            left join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen 
            left join (select id_aduan, waktu from tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                on tb_aduan.id_aduan = progress.id_aduan and progress.waktu >= tb_aduan.waktu
            WHERE status <> 'Request' and status <> 'Returned' 
            GROUP BY tb_aduan.id_aduan
            ORDER BY field(status,'Progress' ,'Open', 'Closed'), tb_aduan.waktu DESC";
    }else if($TOKEN['status_akun']=='Manager'||$TOKEN['status_akun']=='Unit'){
        /** Hanya menampilkan aduan terhadap unit */
        $sintax="SELECT  tb_aduan.id_aduan, jenis, Departemen, tb_aduan.nama_unit, urgensi, perihal, status, level, 
                        progress.id_aduan as merah, tb_aduan.waktu from tb_aduan 
                inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                left join (select id_aduan, waktu from tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                        on tb_aduan.id_aduan = progress.id_aduan and progress.waktu >= tb_aduan.waktu
                where tb_unit.id_unit = '".$TOKEN['id_unit']."'";
        /** Hanya menampilkan aduan terhadap unit */

    }else if($TOKEN['status_akun']=='Senior Manager'){
        /** Hanya menampilkan aduan terhadap departemen dari senior manager */
        $sintax="SELECT tb_aduan.id_aduan, jenis, Departemen, tb_aduan.nama_unit, urgensi, perihal, status, level, 
                        progress.id_aduan as merah, tb_aduan.waktu from tb_aduan 
                inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                left join (select id_aduan, waktu from tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                    on tb_aduan.id_aduan = progress.id_aduan and progress.waktu >= tb_aduan.waktu 
                where tb_departemen.id_departemen = '".$TOKEN['id_departemen']."'";
        /** Hanya menampilkan aduan terhadap departemen dari senior manager */
    }
        $result = array();
        $query = mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
        foreach ( $query as $row){
            $result[] = array(
                'id_aduan' => $row['id_aduan'],
                'jenis' => $row['jenis'],
                'nama_departemen'=>$row['Departemen'],
                'nama_unit' => $row['nama_unit'],
                'urgensi'=>$row['urgensi'],
                'perihal'=>$row['perihal'],
                'status'=>$row['status'],
                'waktu'=>$row['waktu'],
                'merah'=>$row['merah'],
                'level'=>$row['level']
            );
        }
        $result = json_encode(array('success'=>true, 'result'=>$result));
        echo $result;
    ###login sebagai unit
?>