<?php
    include 'header.php';
    if(isset($TOKEN)){
        if($TOKEN['hak_akses']=='Admin1' || $TOKEN['hak_akses']=='Super Admin'){
            $id_aduan = $koneksi -> real_escape_string($_GET['id_aduan']);
            $datarequest = array();
            $query=mysqli_query($koneksi,"SELECT pelapor, Nama,no_telp, email,jenis, 
                                            perihal, ket, tb_aduan.foto, tb_aduan.status, 
                                            nama_lokasi, nama_detail_lokasi, 
                                            nama_perusahaan, gerai, waktu_kejadian, keterangan_kejadian 
                                            from tb_aduan 
                                            left join tb_customer ON tb_aduan.id_customer=tb_customer.id_customer
                                            where tb_aduan.id_aduan ='$id_aduan'");
            $count = mysqli_num_rows($query);
            if($count > 0){
                $data = mysqli_fetch_array($query);
                $datarequest[] = array(
                    'perihal' => $data['perihal'],
                    'keterangan' => $data['ket'],
                    'nama'=>$data['Nama'],
                    "no_telp"=>$data['no_telp'],
                    'nama_perusahaan'=>$data['nama_perusahaan'],
                    'gerai'=>$data['gerai'],
                    'jenis'=>$data['jenis'],
                    'nama_lokasi' => $data['nama_lokasi'],
                    'nama_detail_lokasi' => $data['nama_detail_lokasi'],
                    'waktu_kejadian'=>$data['waktu_kejadian'],
                    'keterangan_kejadian'=>$data['keterangan_kejadian'],
                    'foto'=>$data['foto'],
                 );
                 $result = json_encode(array('success'=>true,'result'=>$datarequest));
            } else {
                $result = json_encode(array('success'=>false, 'message'=>"Id tidak ditemukan"));
            }
        }else{
            $result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
        }
    }else{
		$result= json_encode(array('success'=>false,'message'=>'Anda Tidak memilih akses ke halaman ini'));
    }
    echo $result;
?>