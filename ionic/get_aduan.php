<?php
    require('../koneksi.php');
    $hak_akses = $_POST['user_hak_akses'];
    $status_akun = $_POST['user_status_akun'];
    $aduan = array();
    if(($hak_akses=='Super Admin' || $hak_akses == 'Admin2' || $hak_akses=='Pengawas Internal' || $hak_akses=='Admin1') || ($status_akun=='AOC Head' || $status_akun=='General Manager')){
        $sintax = "SELECT tb_aduan.id_aduan, jenis, Departemen, tb_aduan.nama_unit, urgensi, perihal, tb_aduan.status, level, progress.id_aduan as merah, tb_aduan.waktu, nama_perusahaan, waktu_kirim from tb_aduan 
            left join tb_unit ON tb_aduan.id_unit=tb_unit.id_unit 
            left join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen 
            left join (select id_aduan, waktu from tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                    on tb_aduan.id_aduan = progress.id_aduan and progress.waktu >= tb_aduan.waktu
            left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
            WHERE tb_aduan.status <> 'Request' and tb_aduan.status <> 'Returned' 
            GROUP BY tb_aduan.id_aduan
            ORDER BY field(tb_aduan.status,'Progress' ,'Open', 'Closed'), tb_aduan.waktu DESC";
        }else if($status_akun=='Manager'||$status_akun=='Unit'){
        /** Hanya menampilkan aduan terhadap unit */
        $sintax="SELECT  tb_aduan.id_aduan, jenis, Departemen, tb_aduan.nama_unit, urgensi, perihal, tb_aduan.status, level, progress.id_aduan as merah, tb_aduan.waktu, waktu_kirim from tb_aduan 
                    inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                    left join (select id_aduan, waktu from tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                            on tb_aduan.id_aduan = progress.id_aduan and progress.waktu >= tb_aduan.waktu
                    left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
                    where tb_unit.id_unit = '".$_SESSION['id_unit']."'";
        /** Hanya menampilkan aduan terhadap unit */

        }else if($status_akun=='Senior Manager'){
        /** Hanya menampilkan aduan terhadap departemen dari senior manager */
        $sintax="SELECT  tb_aduan.id_aduan, jenis, Departemen, tb_aduan.nama_unit, urgensi, perihal, tb_aduan.status, level, progress.id_aduan as merah, tb_aduan.waktu, waktu_kirim from tb_aduan 
                inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                left join (select id_aduan, waktu from tb_progress where tindakan like 'Dikembalikan ke unit teknis%') as progress
                        on tb_aduan.id_aduan = progress.id_aduan and progress.waktu >= tb_aduan.waktu 
                left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
                where tb_departemen.id_departemen = '".$_SESSION['id_departemen']."'";
        /** Hanya menampilkan aduan terhadap departemen dari senior manager */
        }
    $data = mysqli_query($koneksi,$sintax) or die(mysqli_error($koneksi));
    foreach($data as $row){
        array_push(
            $aduan, 
            array(
                'id_aduan'=>$row['id_aduan'],
                'perihal'=>$row['perihal'],
                'nama_unit'=>$row['nama_unit'],
                'nama_departemen'=>$row['Departemen'],
                'jenis'=>$row['jenis'],
                'urgensi'=>$row['urgensi'],
                'status'=>$row['status'],
                'waktu'=>$row['waktu'],
                'waktu_kirim'=>$row['waktu_kirim'],
                'level'=>$row['level'],
                'merah'=>$row['merah']
            )
        );
    }
    echo json_encode(array('success'=>true, 'data'=>$aduan));
?>