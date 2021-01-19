<?php
	include '../koneksi.php';
	$data_kembali = [];
	$data_kembali["label"]=[];
	$data_kembali["data"]=[];
	$rentang = $_POST['rentang'];
	$from = $_POST['from'];
	$to = $_POST['to'];
	$kelompok = $_POST['kelompok'];
	if($rentang=='Bulan'){
        $from = date('Y-m-01', strtotime($from));
        $to = date('Y-m-t', strtotime($to));
	}
	if($kelompok=="rata-rata"){
    	if($rentang=='Tahun'){
        	$data = mysqli_query($koneksi,"SELECT avg(penilaian), 'Rata-rata', year(date(waktu_kirim)) FROM tb_aduan 
                                           inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
                                           where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) group by year(date(waktu_kirim)) order by waktu_kirim");
        	foreach($data as $row){
        	    $data_kembali["data"][$row['status']][$row['year(date(waktu_kirim))']]=$row['avg(penilaian)'];
        	    if(!in_array($row['year(date(waktu_kirim))'], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row['year(date(waktu_kirim))']);
        	    }
        	}
    	} else if($rentang =='Bulan'){
    	    $data = mysqli_query($koneksi,"SELECT avg(penilaian), DATE_FORMAT(date(waktu_kirim),'%Y-%m') FROM tb_aduan 
                                            inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
                                            where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
            foreach($data as $row){
        	    $data_kembali["data"]['Rata-rata'][$row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]]=$row['avg(penilaian)'];
        	    if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]);
        	    }
        	}
    	} else {
    	    $data = mysqli_query($koneksi,"SELECT avg(penilaian), 'Rata-rata', DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') FROM tb_aduan  
                                            inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
                                            where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
        	foreach($data as $row){
        	    $data_kembali["data"][$row['status']][$row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]]=$row['avg(penilaian)   '];
        	    if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]);
        	    }
        	}
    	}
	} else {
	    if($rentang=='Tahun'){
        	$data = mysqli_query($koneksi,"SELECT count(id_aduan), jenis, year(date(waktu_kirim)) FROM tb_aduan 
                                            inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
                                            where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) group by penilaian, year(date(waktu_kirim)) order by waktu_kirim");
        	foreach($data as $row){
        	    $data_kembali["data"][$row['jenis']][$row['year(date(waktu_kirim))']]=$row['count(id_aduan)'];
        	    if(!in_array($row['year(date(waktu_kirim))'], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row['year(date(waktu_kirim))']);
        	    }
        	}
    	} else if($rentang =='Bulan'){
        	$data = mysqli_query($koneksi,"SELECT count(id_aduan), jenis, DATE_FORMAT(date(waktu_kirim),'%Y-%m') FROM tb_aduan  
                                            inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
                                            where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by penilaian, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
        	foreach($data as $row){
        	    $data_kembali["data"][$row['jenis']][$row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]]=$row['count(id_aduan)'];
        	    if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"], $data_kembali["label"])){
        	        array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]);
        	    }
        	}
    	} else {
    	    $data = mysqli_query($koneksi,"SELECT count(id_aduan), jenis, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') FROM tb_aduan  
                                            inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
                                            where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by penilaian, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
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