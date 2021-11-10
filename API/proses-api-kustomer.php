<?php
    include 'header.php';
  	if($postjson==null){
		echo json_encode(array('success'=>false));
	}elseif($postjson['aksi']=='get-kustomer'){
	    $data=array();
	    $query=mysqli_query($koneksi, "SELECT * from tb_customer ORDER BY status ASC") or die(mysqli_error($koneksi));
		while($row = mysqli_fetch_array($query)){
	      $data[] = array(
	        'id_kustomer' => $row['id_customer'],
	        'nama' => $row['nama'],
	        'nama_perusahaan' => $row['nama_perusahaan'],
	        'gerai' => $row['gerai'],
	        'status' => $row['status'],
	        'masa_berlaku'=> $row['masa_berlaku'],
	      );
	    }
		if($query) $result=json_encode(array('success'=>true, 'result'=>$data));
		else $result = json_encode(array('success'=>false));
		echo $result;
	} elseif($postjson['aksi']=='get-id-kustomer'){
	    $id_customer = $postjson['id_kustomer'];
		$data =array();
		$query= mysqli_query($koneksi, "SELECT * from tb_customer where id_customer = $id_customer") or die(mysqli_error($koneksi));
    	while($row = mysqli_fetch_array($query)){
	      $data[] = array(
	        'id_kustomer' => $row['id_customer'],
	        'nama' => $row['nama'],
	        'nama_perusahaan' => $row['nama_perusahaan'],
	        'gerai' => $row['gerai'],
	        'email' => $row['email'],
	        'no_telp'=>$row['no_telp'],
	        'id_pass_bandara'=>$row['id_pass_bandara'],
	        'pass_bandara'=>$row['pass_bandara'],
	        'foto'=>$row['foto'],
	        'status' => $row['status'],
	        'masa_berlaku'=> $row['masa_berlaku'],
	        
	      );
    	}
		if($query) $result= json_encode(array('success'=>true,'result'=>$data));
		else $result= json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi']=='aktifkan'){
	    $query = mysqli_query($koneksi, "UPDATE tb_customer SET status=1 where id_customer='$postjson[id_customer]'");
	    $cek_data = mysqli_query($koneksi, "SELECT Email FROM tb_customer where id_customer='$postjson[id_customer]'");
	    if($data = mysqli_fetch_array($cek_data)){
	        $email_customer = $data['Email'];
	        mysqli_query($koneksi, "DELETE from tb_notif where email='$email_customer'");
    	    include('../pesan/aktifkan.php');
    	    if($query) $result = json_encode(array('success'=>true));
    	    else $result = json_encode(array('success'=>false));
    	    echo $result;
	    }
		
	}elseif($postjson['aksi']=='delete-kustomer'){
	    $query = mysqli_query($koneksi, "SELECT * FROM tb_customer where id_customer='$postjson[id_kustomer]'") or die(mysqli_query($koneksi));
	    if($row = mysqli_fetch_array($query)){
	        $foto = $row['foto'];
	        $pass_bandara = $row['pass_bandara'];
	        if($foto){
	            unlink('../gambar/foto/'.$foto);
	        }
	        if($pass_bandara){
	            unlink('../gambar/bypass/'.$pass_bandara);
	        }
	        $delete = mysqli_query($koneksi, "DELETE from tb_customer where id_customer='$postjson[id_kustomer]'") or die(mysqli_query($koneksi));
	        if($delete){
	            $result = json_encode(array('success'=>true));
	        }else{
	            $result = json_encode(array('success'=>false, 'msg'=>'Gagal menghapus data'));
	        }
	    }else{
	        $result = json_encode(array('success'=>false,'msg'=>'Data tidak ditemukan'));
	    }
	    echo $result;
	}
?>