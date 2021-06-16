<?php
	include '../koneksi.php';
	$data_kembali = [];
	$data_kembali["label"]=[];
	$data_kembali["data"]=[];
	$rentang = $_POST['rentang'];
	$from =	date_create_from_format('d/m/Y', $_POST['from']);
	$to = date_create_from_format('d/m/Y', $_POST['to']);
	$from = date_format($from, 'd-m-Y');
	$to = date_format($to, 'd-m-Y');
	$departemen = $_POST['departemen'];
	$unit = $_POST['unit'];
	$kelompok = $_POST['kelompok'];
	if($rentang=='Bulan'){
        $from = date('Y-m-01', strtotime($from));
        $to = date('Y-m-d', strtotime($to));
	}else{
		$from = date('Y-m-d', strtotime($from));
		$to = date('Y-m-d', strtotime($to));
	}
	
		if($departemen=='all'){
			if($rentang=='Tahun'){
				$data = mysqli_query($koneksi,"SELECT count(id_aduan), $kelompok, year(date(waktu_kirim)) FROM tb_aduan where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) group by $kelompok, year(date(waktu_kirim)) order by waktu_kirim");
				foreach($data as $row){
					$data_kembali["data"][$row[$kelompok]][$row['year(date(waktu_kirim))']]=$row['count(id_aduan)'];
					if(!in_array($row['year(date(waktu_kirim))'], $data_kembali["label"])){
						array_push($data_kembali["label"], $row['year(date(waktu_kirim))']);
					}
				}
			} else if($rentang =='Bulan'){
				$data = mysqli_query($koneksi,"SELECT count(id_aduan), $kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') FROM tb_aduan where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by $kelompok, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim");
				foreach($data as $row){
					$data_kembali["data"][$row[$kelompok]][$row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]]=$row['count(id_aduan)'];
					if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"], $data_kembali["label"])){
						array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]);
					}
				}
			} else {
				$data = mysqli_query($koneksi,"SELECT count(id_aduan), $kelompok, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') FROM tb_aduan where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by $kelompok, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
				foreach($data as $row){
					$data_kembali["data"][$row[$kelompok]][$row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]]=$row['count(id_aduan)'];
					if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"], $data_kembali["label"])){
						array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]);
					}
				}
			}
		}else{
			if($unit=='all'){
				if($rentang=='Tahun'){
					$data = mysqli_query($koneksi,"SELECT count(id_aduan), $kelompok, year(date(waktu_kirim)) 
													FROM tb_aduan 
													inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
													where year(date(waktu_kirim))>=year(date('".$from."')) and 
													tb_unit.id_departemen = '".$departemen."' and
													year(date(waktu_kirim)) <= year(date('".$to."')) group by $kelompok, 
													year(date(waktu_kirim)) order by waktu_kirim");
					foreach($data as $row){
						$data_kembali["data"][$row[$kelompok]][$row['year(date(waktu_kirim))']]=$row['count(id_aduan)'];
						if(!in_array($row['year(date(waktu_kirim))'], $data_kembali["label"])){
							array_push($data_kembali["label"], $row['year(date(waktu_kirim))']);
						}
					}
				} else if($rentang =='Bulan'){
					$data = mysqli_query($koneksi,"SELECT count(id_aduan), $kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') 
													FROM tb_aduan 
													inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
													where date(waktu_kirim)>=date('".$from."') and 
													tb_unit.id_departemen = '".$departemen."' and
													date(waktu_kirim) <= date('".$to."') group by $kelompok, 
													DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim");
					foreach($data as $row){
						$data_kembali["data"][$row[$kelompok]][$row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]]=$row['count(id_aduan)'];
						if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"], $data_kembali["label"])){
							array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]);
						}
					}
				} else {
					$data = mysqli_query($koneksi,"SELECT count(id_aduan), $kelompok, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') 
													FROM tb_aduan 
													inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
													where date(waktu_kirim)>=date('".$from."') and 
													tb_unit.id_departemen = '".$departemen."' and
													date(waktu_kirim) <= date('".$to."') group by $kelompok,
													 DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
					foreach($data as $row){
						$data_kembali["data"][$row[$kelompok]][$row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]]=$row['count(id_aduan)'];
						if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"], $data_kembali["label"])){
							array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]);
						}
					}
				}
			}else{
				if($rentang=='Tahun'){
					$data = mysqli_query($koneksi,"SELECT count(id_aduan), $kelompok, year(date(waktu_kirim)) 
													FROM tb_aduan 
													where year(date(waktu_kirim))>=year(date('".$from."')) and 
													tb_aduan.id_unit = '".$unit."' and
													year(date(waktu_kirim)) <= year(date('".$to."')) group by $kelompok, 
													year(date(waktu_kirim)) order by waktu_kirim");
					foreach($data as $row){
						$data_kembali["data"][$row[$kelompok]][$row['year(date(waktu_kirim))']]=$row['count(id_aduan)'];
						if(!in_array($row['year(date(waktu_kirim))'], $data_kembali["label"])){
							array_push($data_kembali["label"], $row['year(date(waktu_kirim))']);
						}
					}
				} else if($rentang =='Bulan'){
					$data = mysqli_query($koneksi,"SELECT count(id_aduan), $kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') 
													FROM tb_aduan 
													where date(waktu_kirim)>=date('".$from."') and 
													tb_aduan.id_unit = '".$unit."' and
													date(waktu_kirim) <= date('".$to."') group by $kelompok, 
													DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim");
					foreach($data as $row){
						$data_kembali["data"][$row[$kelompok]][$row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]]=$row['count(id_aduan)'];
						if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"], $data_kembali["label"])){
							array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%Y-%m')"]);
						}
					}
				} else {
					$data = mysqli_query($koneksi,"SELECT count(id_aduan), $kelompok, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') 
													FROM tb_aduan 
													where date(waktu_kirim)>=date('".$from."') and 
													tb_aduan.id_unit = '".$unit."' and
													date(waktu_kirim) <= date('".$to."') group by $kelompok,
													 DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");

					foreach($data as $row){
						$data_kembali["data"][$row[$kelompok]][$row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]]=$row['count(id_aduan)'];
						if(!in_array($row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"], $data_kembali["label"])){
							array_push($data_kembali["label"], $row["DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y')"]);
						}
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