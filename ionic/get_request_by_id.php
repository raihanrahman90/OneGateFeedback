<?php
    require('../koneksi.php');
    $hak_akses = $_POST['user_hak_akses'];
    $status_akun = $_POST['user_status_akun'];
    $id_aduan = $_GET['id_aduan'];
    $aduan = array();
    $data = mysqli_query($koneksi, "SELECT pelapor, Nama,no_telp, email,jenis, 
                                    perihal, ket, tb_aduan.foto, tb_aduan.status, 
                                    nama_lokasi, nama_detail_lokasi, tindakan,
                                    nama_perusahaan, gerai, waktu_kejadian, keterangan_kejadian 
                                    from tb_aduan 
                                    left join tb_customer ON tb_aduan.id_customer=tb_customer.id_customer
                                    left join tb_progress ON tb_aduan.id_aduan = tb_progress.id_aduan
                                where tb_aduan.id_aduan ='$id_aduan'") or die(mysqli_error($koneksi));
    $data = mysqli_fetch_array($data);
    if($data['status']=='Returned'){
        $keterangan_return = mysqli_query($koneksi, "SELECT * FROM tb_progress where id_aduan='$id_aduan'");
        $keterangan_return = mysqli_fetch_array($keterangan_return);
    }
    $aduan = array(
        'pelapor'=>$data['pelapor'],
        'nama'=>$data['Nama'],
        'no_telp'=>$data['no_telp'],
        'email'=>$data['email'],
        'jenis'=>$data['jenis'],
        'perihal'=>$data['perihal'],
        'keterangan'=>$data['ket'],
        'foto'=>$data['foto'],
        'status'=>$data['status'],
        'nama_lokasi'=>$data['nama_lokasi'],
        'nama_detail_lokasi'=>$data['nama_detail_lokasi']
    );
    echo json_encode(array('success'=>true, 'data'=>$aduan));
?>