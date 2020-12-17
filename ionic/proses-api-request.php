<?php
    include 'header.php';
    include '../link.php';
    if($postjson==null){
		echo json_encode(array('success'=>false));
	}elseif($postjson['aksi']=='get-request'){
	    $data=array();
        if($postjson['hak_akses']=='Super Admin' || $postjson['hak_akses']=='Admin1'){
            $query = mysqli_query($koneksi, "SELECT *, tb_aduan.status as status_aduan from tb_aduan 
             left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
            WHERE (tb_aduan.status = 'Request' or tb_aduan.status='Returned') 
            and level>-1 
            ORDER BY waktu ASC") or die(mysqli_error($koneksi));
        } else {
            $query = mysqli_query($koneksi, "SELECT * from tb_aduan where 
            id_akun='$postjson[id_akun]' ORDER BY waktu DESC");
        }
		while($row = mysqli_fetch_array($query)){
			$data[] = array(
				'id_aduan' => $row['id_aduan'],
				'perihal' => $row['perihal'],
				'status'=>$row['status_aduan'],
				'waktu' => $row['waktu'],
				'nama_perusahaan'=>$row['nama_perusahaan']
			);
	    }
	    if($query) $result=json_encode(array('success'=>true, 'result'=>$data));
		else $result = json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi']=='get-id-request'){
		$datareqest = array();
		$query=mysqli_query($koneksi,"SELECT * FROM tb_aduan 
			LEFT JOIN tb_detail_lokasi on tb_detail_lokasi.id_detail_lokasi = tb_aduan.id_detail_lokasi 
			LEFT JOIN tb_lokasi on tb_lokasi.id_lokasi = tb_detail_lokasi.id_lokasi 
			where id_aduan='$postjson[id_aduan]'");
		$count = mysqli_num_rows($query);
		if($count > 0){
			$data = mysqli_fetch_array($quer);
			$datarequest = array(
				'perihal' => $data['perihal'],
				'keterangan' => $data['ket'],
				'nama_detail_lokasi' => $data['nama_detail_lokasi'],
				'nama_lokasi' => $data['nama_lokasi'],
				'waktu'=>$data['waktu']
 			);
 			$result = json_encode(array('success'=>true,'result'=>$datarequest));
		} else {
			$result = json_encode(array('success'=>false));
		}
		echo $result;
	}elseif($postjson['aksi']=='teruskan'){
		$subject = 'Keluhan Baru Terhadap unit Anda';
		$id_aduan = $postjson['id_aduan'];
		$id_akun = $postjson['id_akun'];
		$query =mysqli_query($koneksi, "UPDATE tb_aduan SET status='Open', id_unit = '$postjson[id_unit]', id_akun='$postjson[id_akun]', level=1 where id_aduan = '$id_aduan'") or die(mysqli_error($koneksi));
    	$tindakan = mysqli_query($koneksi, "INSERT INTO tb_progress values(0, $id_akun,'$id_aduan', 'Diteruskan ke unit', NULL, now())");
		$id_aduan = $postjson['id_aduan'];
		$id_unit = $postjson['id_unit'];
		include "../pesan/kirim_email_unit.php";
		if($query) $result=json_encode(array('success'=>true));
		else $result =json_encode(array('success'=>false));
		echo $result;
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