<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8");
	include '../koneksi.php';
	$data_kembali = [];
	$data_kembali["label"]=[];
	$data_kembali["data"]=[];
	$rentang = $_POST['rentang'];
	$from = $_POST['from'];
	$to = $_POST['to'];
	$kelompok = $_POST['kelompok'];
	
	$data_kembali["input"]=[$rentang, $from, $to, $kelompok];
	if($rentang=='Bulan'){
        $from = date('Y-m-01', strtotime($from));
        $to = date('Y-m-t', strtotime($to));
	}
	if($kelompok=="status"){
    	if($rentang=='Tahun'){
        	$data = mysqli_query($koneksi,"SELECT count(id_aduan), status, year(date(waktu_kirim)) FROM tb_aduan where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) group by status, year(date(waktu_kirim)) order by waktu_kirim");
        	foreach($data as $row){
        	    $data_kembali["data"][$row['status']][$row['year(date(waktu_kirim))']]=$row['count(id_aduan)'];
        	    if(!in_array($row['year(date(waktu_kirim))'], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row['year(date(waktu_kirim))']);
        	    }
        	}
    	} else if($rentang =='Bulan'){
    	    $data = mysqli_query($koneksi,"SELECT count(id_aduan), status, DATE_FORMAT(date(waktu_kirim),'%Y-%m') FROM tb_aduan where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by status, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim");
        	foreach($data as $row){
        	    $data_kembali["data"][$row['status']][$row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]]=$row['count(id_aduan)'];
        	    if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]);
        	    }
        	}
    	} else {
    	    $data = mysqli_query($koneksi,"SELECT count(id_aduan), status, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') FROM tb_aduan where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by status, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
        	foreach($data as $row){
        	    $data_kembali["data"][$row['status']][$row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]]=$row['count(id_aduan)'];
        	    if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]);
        	    }
        	}
    	}
	} else {
	    if($rentang=='Tahun'){
        	$data = mysqli_query($koneksi,"SELECT count(id_aduan), jenis, year(date(waktu_kirim)) FROM tb_aduan where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) group by jenis, year(date(waktu_kirim)) order by waktu_kirim");
        	foreach($data as $row){
        	    $data_kembali["data"][$row['jenis']][$row['year(date(waktu_kirim))']]=$row['count(id_aduan)'];
        	    if(!in_array($row['year(date(waktu_kirim))'], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row['year(date(waktu_kirim))']);
        	    }
        	}
    	} else if($rentang =='Bulan'){
        	$data = mysqli_query($koneksi,"SELECT count(id_aduan), jenis, DATE_FORMAT(date(waktu_kirim),'%Y-%m') FROM tb_aduan where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by jenis, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim");
        	foreach($data as $row){
        	    $data_kembali["data"][$row['jenis']][$row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]]=$row['count(id_aduan)'];
        	    if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]);
        	    }
        	}
    	} else {
    	    $data = mysqli_query($koneksi,"SELECT count(id_aduan), jenis, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') FROM tb_aduan where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by jenis, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
        	foreach($data as $row){
        	    $data_kembali["data"][$row['jenis']][$row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]]=$row['count(id_aduan)'];
        	    if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]);
        	    }
        	}
    	}
	}
	foreach($data_kembali["label"] as $row){
		foreach($data_kembali['data'] as $col=>$value){
			if(!isset($data_kembali['data'][$col][$row])){
				$data_kembali['data'][$col][$row]=0;
			}		
		}
	}
	echo json_encode($data_kembali);
?>