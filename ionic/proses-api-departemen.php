<?php
    include 'header.php';
    if($postjson==null){
		echo json_encode(array('success'=>false));
	}elseif($postjson['aksi']=='insert-departemen'){
	    $nama_departemen = $koneksi ->real_escape_string($postjson['nama_departemen']);
		$query = mysqli_query($koneksi, "INSERT INTO tb_departemen VALUES(
			0,
			'$nama_departemen'
			)") or die(mysqli_query($koneksi));
		if($query) $result=json_encode(array('success'=>true));
		else $result =json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi']=='get-departemen'){
	    $data=array();
		$query=mysqli_query($koneksi, "SELECT tb_departemen.id_departemen,tb_departemen.Departemen, count(id_unit) as jumlah from tb_departemen
		left join tb_unit on tb_departemen.id_departemen = tb_unit.id_departemen 
		group by tb_departemen.id_departemen") or die(mysqli_error($koneksi));
		while($row = mysqli_fetch_array($query)){
			$data[] = array(
				'id_departemen' => $row['id_departemen'],
				'nama_departemen' => $row['Departemen'],
				'jumlah'=>$row['jumlah']
				
			);
	    }
	    if($query) $result=json_encode(array('success'=>true, 'result'=>$data));
		else $result = json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi']=='update-departemen'){
	    $nama_departemen = $koneksi ->real_escape_string($postjson['nama_departemen']);
		$query = mysqli_query($koneksi, "UPDATE tb_departemen set Departemen='$nama_departemen' where id_departemen='$postjson[id_departemen]'");
	    if($query) $result=json_encode(array('success'=>true));
	    else $result = json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi']=='get-unit'){
	    $data = array();
	    $nama_departemen='';
	    $query=mysqli_query($koneksi, "SELECT * from tb_unit 
	    left join tb_departemen on tb_unit.id_departemen= tb_departemen.id_departemen 
	    where tb_departemen.id_departemen ='$postjson[id_departemen]'");
	    while($row = mysqli_fetch_array($query)){
	        $nama_departemen = $row['Departemen'];
	        $data[] = array(
	            'id_unit'=>$row['id_unit'],
	            'nama_unit'=>$row['nama_unit']
	        );
	    }
	    if($query) $result = json_encode(array('success'=>true, 'nama_departemen'=>$nama_departemen, 'result'=>$data));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi']=='insert-unit'){
	    $nama_unit = $koneksi ->real_escape_string($postjson['nama_unit']);
	    $query=mysqli_query($koneksi, "INSERT INTO tb_unit value(0,'$postjson[id_departemen]', '$nama_unit')");
	    if($query) $result=json_encode(array('success'=>true));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi']=='update-unit'){
	    $nama_unit = $koneksi ->real_escape_string($postjson['nama_unit']);
	    $query=mysqli_query($koneksi, "UPDATE tb_unit set nama_unit='$nama_unit' where id_unit='$postjson[id_unit]'");
	    if($query) $result=json_encode(array('success'=>true));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi']=='delete-unit'){
	    $query=mysqli_query($koneksi, "DELETE FROM tb_unit where id_unit='$postjson[id_unit]'");
	    if($query)$result=json_encode(array('success'=>true));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi']=='delete-departemen'){
	    $query=mysqli_query($koneksi, "DELETE FROM tb_departemen where id_departemen='$postjson[id_departemen]'");
	    if($query)$result=json_encode(array('success'=>true));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi']=='get-departemen-list'){
        $departemen = array();
	    $unit = array();
	    $query=mysqli_query($koneksi, "SELECT tb_departemen.id_departemen,Departemen from tb_departemen");
	    while($row = mysqli_fetch_array($query)){
	        $unit = array();
	        $query1 = mysqli_query($koneksi, "Select * from tb_unit where id_departemen ='$row[id_departemen]'");
	        while($row1 =   mysqli_fetch_array($query1)){
	            $unit[] = array(
	                'id_unit'   => $row1['id_unit'],
	                'nama_unit' =>$row1['nama_unit']
	            );
	        }
	        $departemen[] = array(
	            'id_departemen'=>$row['id_departemen'],
	            'Departemen'=>$row['Departemen'],
	            'unit'=>$unit
	       );
	    }
	    if($query && $query1) $result=json_encode(array('success'=>true, 'result'=>$departemen));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	}
?>