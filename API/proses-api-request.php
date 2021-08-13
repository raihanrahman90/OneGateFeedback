<?php
    include 'header.php';
    include '../link.php';
    if($postjson==null){
		echo json_encode(array('success'=>false));
	}elseif($postjson['aksi']=='teruskan'){
	}elseif($postjson['aksi']=='pertanyaan'){
	    $id_aduan = $postjson['id_aduan'];
	    $pertanyaan = $koneksi -> real_escape_string($postjson['pertanyaan']);
        $query= mysqli_query($koneksi, "INSERT INTO tb_keterangan_tambahan VALUES(0, $id_aduan,$postjson[id_akun], '$pertanyaan', NULL, NULL, NULL)");
        $id_keterangan = mysqli_insert_id($koneksi);
        $id_link = md5($id_keterangan);
        $update = mysqli_query($koneksi, "UPDATE tb_keterangan_tambahan SET link ='$id_link'  where id_keterangan='$id_keterangan'");
        $query1 = mysqli_query($koneksi, "SELECT email, nama from tb_customer 
                inner join tb_aduan on tb_aduan.id_customer = tb_customer.id_customer where id_aduan = $id_aduan");
        $masuk = 'tdkk masuk';
        $kirim = true;
        if($query1){
            $masuk = 'masuk';
            $data = mysqli_fetch_array($query1);
            $email = $data['email'];
            $nama = $data['nama'];
            include '../pesan/keterangan_tambahan.php';
        }
        if($kirim && $update && $query){
            $result = json_encode(array('success'=>true));
        }else if($update && $query){
            $result = json_encode(array('success'=>false,'msg'=>'Email pengirim tidak ditemukan'));
        } else {
            $result = json_encode(array('success'=>false, 'msg'=>'Gagal menambahkan pertanyaan'));
        }
        echo $result;
	} elseif($postjson['aksi']=='get-keterangan-tambahan'){
	    $id_aduan = $postjson['id_aduan'];
	    $hasil = array();
	    $query = mysqli_query($koneksi, "SELECT * FROM tb_keterangan_tambahan where id_aduan='$postjson[id_aduan]'");
	    while($row = mysqli_fetch_array($query)){
	        $hasil[] = array(
	            'pertanyaan'=>$row['pertanyaan'],
	            'jawaban'=>$row['jawaban']   
	        );
	    }
	    if($query) $result = json_encode(array('success'=>true, 'result'=>$hasil));
	    else $result = json_encode(array('success'=>false));
	    echo $result;
	}
?>