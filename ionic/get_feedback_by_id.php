<?php
    require('../koneksi.php');
    $id = $_GET['id_aduan'];
    $aduan = array();
    $data = mysqli_query($koneksi,"SELECT Email, jenis, pelapor, ket, nama_lokasi, nama_detail_lokasi, 
                                        tb_aduan.status, tb_aduan.foto, tindakan, bukti, tb_progress.waktu as waktu_progress, 
                                        tb_aduan.id_unit as unit, nama_departemen, nama_unit, penilaian, ulasan, perihal,
                                        nama_perusahaan, gerai, waktu_kejadian, keterangan_kejadian
                                        from tb_aduan
                                    left join tb_progress ON tb_aduan.id_aduan = tb_progress.id_aduan 
                                    left join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan
                                    left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
                                    where tb_aduan.id_aduan ='$id' ORDER BY id_progress ASC") or die(mysqli_error($koneksi));
    $data = mysqli_fetch_array($data);
    $aduan = array(
        'Email'=>$data['Email'],
        'jenis'=>$data['jenis'],
        'pelapor'=>$data['pelapor'],
        'ket'=>$data['ket'],
        'nama_lokasi'=>$data['nama_lokasi'],
        'nama_detail_lokasi'=>$data['nama_detail_lokasi'],
        'status'=>$data['status'],
        'foto'=>$data['foto'],
        'nama_departemen'=>$data['nama_departemen'],
        'nama_unit'=>$data['nama_unit'],
        'penilaian'=>$data['penilaian'],
        'ulasan'=>$data['ulasan'],
        'perihal'=>$data['perihal'],
        'nama_perusahaan'=>$data['nama_perusahaan'],
        'gerai'=>$data['gerai'],
        'waktu_kejadian'=>$data['waktu_kejadian'],
        'keterangan_kejadian'=>$data['keterangan_kejadian']
    );
    echo json_encode(array('success'=>true, 'data'=>$aduan));
?>