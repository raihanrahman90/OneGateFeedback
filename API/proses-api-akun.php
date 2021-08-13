<?php
    include 'header.php';
	if($postjson==null){
		echo json_encode(array('success'=>false));
	}elseif($postjson['aksi']=='get-akun'){
	    $data=array();
		$query=mysqli_query($koneksi, "SELECT * from tb_akun 
	      LEFT JOIN tb_unit ON tb_akun.id_unit=tb_unit.id_unit 
	      LEFT JOIN tb_departemen on tb_akun.id_departemen = tb_departemen.id_departemen 
	      ORDER BY Nama DESC") or die(mysqli_error($koneksi));
	    while($row = mysqli_fetch_array($query)){
	      $data[] = array(
	        'id_akun' => $row['Id_akun'],
	        'Nama' => $row['Nama'],
	        'nama_unit' => $row['nama_unit'],
	        'Departemen' => $row['Departemen'],
	        'status' => $row['status'],
	        'hak_akses'=> $row['hak_akses'],
	      );
	    }
		if($query) $result=json_encode(array('success'=>true, 'result'=>$data));
		else $result = json_encode(array('success'=>false));
		echo $result;
	} elseif($postjson['aksi']=='get-id-akun'){
	    $id_akun = $postjson['id_akun'];
		$dataakun =array();
		$status= mysqli_query($koneksi, "SELECT status from tb_akun where Id_akun = $id_akun") or die(mysqli_error($koneksi));
		$status = mysqli_fetch_array($status);
        $status = $status['status'];
            $data = mysqli_query($koneksi, "SELECT  Nama, tb_departemen.id_departemen, tb_unit.id_unit, status,hak_akses, Email, Id_akun, No_Telp, nama_unit, Departemen  FROM tb_akun left join tb_departemen on tb_departemen.id_departemen = tb_akun.id_departemen left join tb_unit on tb_unit.id_unit = tb_akun.id_unit WHERE Id_akun ='$id_akun'") or die(mysqli_error($koneksi));
            $row =  mysqli_fetch_array($data);
        $dataakun[] = array(
				'departemen'    => $row['Departemen'],
				'nama_unit'     => $row['nama_unit'],
				'status'        => $row['status'],
				'nama'          => $row['Nama'],
				'email'         => $row['Email'],
				'no_telp'       => $row['No_Telp'],
				'hak_akses'     => $row['hak_akses'],
				'id_departemen' => $row['id_departemen'],
				'id_unit'       => $row['id_unit']
		    );
		if ($status) $result= json_encode(array('success'=>true,'result'=>$dataakun));
		else $result= json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi']=='insert-akun'){
		$status = $postjson['status'];
		$nama = $koneksi ->real_escape_string($postjson['nama']);
		$email = $koneksi ->real_escape_string($postjson['email']);
		$password = $koneksi ->real_escape_string($postjson['password']);
		$no_telp = $koneksi ->real_escape_string($postjson['no_telp']);
		if($status== 'Senior Manager'){
			$id_unit = 'NULL';
			$id_departemen = $postjson['id_departemen'];
		} elseif($status=="General Manager" || $status=="AOC Head"){
			$id_unit = 'NULL';
			$id_departemen = 'NULL';
		} else {
			$id_unit=$postjson['id_unit'];
			$id_departemen = $postjson['id_departemen'];
		}
		$email_valid = true;
		$cari = mysqli_query($koneksi, "SELECT * from tb_akun where email='$email'") or die(mysqli_error($koneksi));
		if($row=mysqli_fetch_array($cari)){
		   $email_valid=false;
		}
		if($email_valid){
    		$sintax = "INSERT INTO tb_akun VALUES(
    			0,
    			$id_departemen,
    			$id_unit,
    			'$nama',
    			'$email',
    			md5('$password'),
    			'$no_telp',
    			'$status',
    			'$postjson[hak_akses]',
    			NULL
    			)";
    		$query = mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
		}
		if($email_valid && $query) $result=json_encode(array('success'=>true));
		else if($query) $result=json_encode(array('success'=>false, 'msg'=>'Email telah digunakan'));
		else $result =json_encode(array('success'=>false, 'msg'=>'Terjadi Kesalahan'));
		echo $result;
	}elseif($postjson['aksi']=='setting-akun'){
	    $id_akun = $postjson['id_akun'];
		$nama = $koneksi ->real_escape_string($postjson['nama']);
		$email = $koneksi ->real_escape_string($postjson['email']);
		$password = $koneksi ->real_escape_string($postjson['password']);
		$no_telp = $koneksi ->real_escape_string($postjson['no_telp']);
    	$query = mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE Email='$email'") or die(mysqli_error($koneksi));
    	$jumlah_data = mysqli_num_rows($query);
    	$data_email_akun = mysqli_fetch_array($query);
    	$data = false;
    	if($data_email_akun['Id_akun']!=$id_akun && $jumlah_data>0){
        	$msg='Email telah digunakan';
    	} else {
        	if($postjson['default']){
        		$data = mysqli_query($koneksi, "UPDATE tb_akun SET Nama='$nama', Email='$email', No_Telp='$no_telp', password=md5('$password') where id_akun='$id_akun'")or die(mysqli_error($koneksi));
    		} else {
        	    $data = mysqli_query($koneksi, "UPDATE tb_akun SET Nama='$nama', Email='$email', No_Telp='$no_telp' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
        	}
    	}
    	if($data && $query) $result = json_encode(array('success'=>true));
    	elseif($query) $result = json_encode(array('success'=>false, 'msg'=>$msg));
    	else $result = json_encode(array('success'=>false, 'msg'=>'Terjadi Kesalahan'));
    	echo $result;
 	}elseif($postjson['aksi']=='password-check-akun'){
        $hasil = array();
		$password = $koneksi ->real_escape_string($postjson['password']);
        $query = mysqli_query($koneksi, "SELECT * FROM tb_akun where id_akun='$postjson[id_akun]' and password=md5('$password')") or die(mysqli_error($koneksi));
        $jumlah_data = mysqli_num_rows($query);
        if($jumlah_data>0) $result = json_encode(array('success'=>true, 'hasil'=>$hasil));
        else $result = json_encode(array('success'=>false));
        echo $result;
	}elseif($postjson['aksi']=='delete-akun'){
	    $query = mysqli_query($koneksi, "DELETE FROM tb_akun where id_akun='$postjson[id_akun]'");
	    if($query) $result = json_encode(array('success'=>true));
	    else $result = json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi']=='update-akun'){
	    	$id_akun = $koneksi-> real_escape_string($postjson['id_akun']);
        	$status = $koneksi-> real_escape_string($postjson['status']);
        	$id_unit = $koneksi-> real_escape_string($postjson['id_unit']);
        	$id_departemen = $koneksi-> real_escape_string($postjson['id_departemen']);
        	$nama = $koneksi-> real_escape_string($postjson['nama']);
        	$email = $koneksi-> real_escape_string($postjson['email']);
        	$no_telp = $koneksi-> real_escape_string($postjson['no_telp']);
        	$password = $koneksi -> real_escape_string($postjson['password']);
        	$hak_akses = $koneksi -> real_escape_string($postjson['hak_akses']);
        	$data_email_akun = mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE Email='$email'") or die(mysqli_error($koneksi));
        	$data_email_akun = mysqli_fetch_array($data_email_akun);
        	if($data_email_akun['Id_akun']!=$id_akun && isset($data_email_akun['Id_akun'])){
        	    $result = json_encode(array('success'=>false, 'msg'=>'Email telah digunakan'));
        	} else {
            	if($status=='Senior Manager'){
            		if($postjson['changepassword']){
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit=NULL, id_departemen='$id_departemen', Nama='$nama', Email='$email', No_Telp='$no_telp', password=md5('$password'), status = '$status', hak_akses='$hak_akses' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		} else {
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit=NULL, id_departemen='$id_departemen', Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		}
            	} else if($status == 'Manager' || $status == 'Unit'){
            		if($postjson['changepassword']){
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit='$id_unit', id_departemen='$id_departemen', Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses', password=md5('$password') where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		} else {
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit='$id_unit', id_departemen='$id_departemen', Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		}
            	} else{
            		if($postjson['changepassword']){
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit=NULL, id_departemen=NULL, Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses', password=md5('$password') where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		} else {
            		    $data = mysqli_query($koneksi, "UPDATE tb_akun SET id_unit=NULL, id_departemen=NULL, Nama='$nama', Email='$email', No_Telp='$no_telp', status = '$status', hak_akses='$hak_akses' where id_akun='$id_akun'")or die(mysqli_error($koneksi));
            		}
            	}
            	if($data) $result = json_encode(array('success'=>true));
            	else $result = json_encode(array('success'=>false, 'msg'=>'Terjadi kesalahan'));
        	}
        	echo $result;
	}
?>