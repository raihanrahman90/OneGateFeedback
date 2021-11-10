<?php
    include 'header.php';
    if($postjson==null){
		echo json_encode(array('success'=>false));
	}elseif($postjson['aksi']=='insert-lokasi'){
	    
	    $nama_lokasi = $koneksi-> real_escape_string($postjson['nama_lokasi']);
		$query = mysqli_query($koneksi, "INSERT INTO tb_lokasi VALUES(
			0,
			'$nama_lokasi'
			)");
		if($query) $result=json_encode(array('success'=>true));
		else $result =json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi'] == 'get-lokasi'){
	    $data = array();
	    $query=mysqli_query($koneksi, "SELECT tb_lokasi.id_lokasi,nama_lokasi, count(tb_detail_lokasi.id_lokasi) as jumlah from tb_lokasi left join tb_detail_lokasi on tb_lokasi.id_lokasi = tb_detail_lokasi.id_lokasi group by tb_lokasi.id_lokasi");
	    while($row = mysqli_fetch_array($query)){
	        $data[] = array(
	            'id_lokasi' => $row['id_lokasi'],
	            'nama_lokasi' => $row['nama_lokasi'],
	            'jumlah' => $row['jumlah']
	        );
	    }
	    if($query) $result=json_encode(array('success'=>true, 'result'=>$data));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi'] == 'get-lokasi-list'){
	    $lokasi = array();
	    $detail_lokasi = array();
	    $id_lokasi_sekarang=null;
	    $query=mysqli_query($koneksi, "SELECT tb_lokasi.id_lokasi,nama_lokasi from tb_lokasi");
	    while($row = mysqli_fetch_array($query)){
	        $detail_lokasi = array();
	        
	        $query1 = mysqli_query($koneksi, "Select * from tb_detail_lokasi where id_lokasi ='$row[id_lokasi]'");
	        while($row1=mysqli_fetch_array($query1)){
	            $detail_lokasi[] = array(
	                'id_detail_lokasi'=> $row1['id_detail_lokasi'],
	                'nama_detail_lokasi'=>$row1['nama_detail_lokasi']
	            );
	        }
	        $lokasi[] = array(
	            'id_lokasi'=>$row['id_lokasi'],
	            'nama_lokasi'=>$row['nama_lokasi'],
	            'detail_lokasi'=>$detail_lokasi
	       );
	    }
	    if($query && $query1) $result=json_encode(array('success'=>true, 'result'=>$lokasi));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	} elseif($postjson['aksi']=="get-lokasi-by-id"){
	    $data = array();
	    $nama_lokasi='';
	    $query = mysqli_query($koneksi, "SELECT nama_lokasi, nama_detail_lokasi, id_detail_lokasi FROM tb_lokasi inner join tb_detail_lokasi on tb_lokasi.id_lokasi = tb_detail_lokasi.id_lokasi where tb_lokasi.id_lokasi = '$postjson[id_lokasi]'");
	    while($row = mysqli_fetch_array($query)){
	        $nama_lokasi = $row['nama_lokasi'];
	        $data[] = array(
	            'id_detail_lokasi'=>$row['id_detail_lokasi'],
	            'nama_detail_lokasi'=>$row['nama_detail_lokasi']
	       );
	    }
	    if($query) $result = json_encode(array('success'=>true, 'nama_lokasi'=>$nama_lokasi, 'detail_lokasi'=>$data));
	    else $result =json_encode(array('success'=>false));
	    echo $result;
	} elseif($postjson['aksi']=="insert-detail-lokasi"){
	    
	    $nama_detail_lokasi = $koneksi-> real_escape_string($postjson['nama_detail_lokasi']);
	    $query= mysqli_query($koneksi, "INSERT into tb_detail_lokasi value(0, '$postjson[id_lokasi]', '$nama_detail_lokasi')");
	    if($query) $result=json_encode(array('success'=>true));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	} elseif($postjson['aksi']=="update-lokasi"){
	    
	    $nama_lokasi = $koneksi-> real_escape_string($postjson['nama_lokasi']);
	    $query=mysqli_query($koneksi, "UPDATE tb_lokasi set nama_lokasi='$nama_lokasi' where id_lokasi='$postjson[id_lokasi]'");
        if($query) $result=json_encode(array('success'=>true));
        else $result=json_encode(array('success'=>false));
        echo $result;
	} elseif($postjson['aksi']=="update-detail-lokasi"){
	    
	    $nama_detail_lokasi = $koneksi-> real_escape_string($postjson['nama_detail_lokasi']);
	    $query=mysqli_query($koneksi, "UPDATE tb_detail_lokasi set nama_detail_lokasi='$nama_detail_lokasi' where id_detail_lokasi='$postjson[id_detail_lokasi]'");
        if($query) $result=json_encode(array('success'=>true));
        else $result=json_encode(array('success'=>false));
        echo $result;
	} elseif($postjson['aksi']=="delete-lokasi"){
	    $query = mysqli_query($koneksi, "delete from tb_lokasi where id_lokasi='$postjson[id_lokasi]'");
	    if($query) $result=json_encode(array('success'=>true));
	    else $result = json_encode(array('success'=>false));
	    echo $result;
	} elseif($postjson['aksi']=="delete-detail-lokasi"){
	    $query = mysqli_query($koneksi, "delete from tb_detail_lokasi where id_detail_lokasi = '$postjson[id_detail_lokasi]'");
	    if($query) $result=json_encode(array('success'=>true));
	    else $result = json_encode(array('success'=>false));
	    echo $result;
	}
?>