<?php
    require('../koneksi.php');
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
        $keterangan_return = mysqli_query($koneksi, "SELECT * FROM tb_progress where id_aduan='$id_aduan' order by id_progress desc");
        $keterangan_return = mysqli_fetch_array($keterangan_return);
        $keterangan_return = $keterangan_return['tindakan'];
    }else{
        $keterangan_return = null;
    }
    $aduan = array(
        'nama_perusahaan'=>$data['nama_perusahaan'],
        'gerai'=>$data['gerai'],
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
        'nama_detail_lokasi'=>$data['nama_detail_lokasi'],
        'keterangan_return'=>$keterangan_return,
        'waktu_kejadian'=>$data['waktu_kejadian'],
        'keterangan_kejadian'=>$data['keterangan_kejadian']
    );
    echo json_encode(array('success'=>true, 'data'=>$aduan));
?>