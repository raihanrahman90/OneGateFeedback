<?php
    include 'header.php';
    if($postjson==null){
		echo json_encode(array('success'=>false));
	}elseif($postjson['aksi']=='insert-urgensi'){
	    
	    $perihal = $koneksi-> real_escape_string($postjson['perihal']);
		$query = mysqli_query($koneksi, "INSERT INTO tb_urgensi VALUES(
			0,
			'$perihal'
			)");
		if($query) $result=json_encode(array('success'=>true));
		else $result =json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi'] == 'get-urgensi'){
	    echo $result;
	} elseif($postjson['aksi']=="update-urgensi"){
        $perihal = $koneksi-> real_escape_string($postjson['perihal']);
        $id_urgensi = $koneksi -> real_escape_string($postjson['id_urgensi']);
	    $query=mysqli_query($koneksi, "UPDATE tb_urgensi set perihal='$perihal' where id_urgensi='$id_urgensi'") or die(mysqli_error($koneksi));
        if($query) $result=json_encode(array('success'=>true));
        else $result=json_encode(array('success'=>false));
        echo $result;
	} elseif($postjson['aksi']=="delete-urgensi"){
        $id_urgensi = $koneksi->real_escape_string($postjson['id_urgensi']);
	    $query = mysqli_query($koneksi, "delete from tb_urgensi where id_urgensi='$id_urgensi'");
	    if($query) $result=json_encode(array('success'=>true));
	    else $result = json_encode(array('success'=>false));
	    echo $result;
	}
?>