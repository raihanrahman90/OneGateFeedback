<?php
	include '../koneksi.php';
	$data_kembali = [];
	$data_kembali["label"]=[];
	$data_kembali["data"]=[];
	$rentang = $_POST['rentang'];
	$from = $_POST['from'];
	$to = $_POST['to'];
	$departemen = $_POST['departemen'];
	$unit = $_POST['unit'];
	$kelompok = $_POST['kelompok'];
	if($rentang=='Bulan'){
        $from = date('Y-m-01', strtotime($from));
        $to = date('Y-m-t', strtotime($to));
	}
	if($kelompok=="rata-rata"){
		if($departemen=='all'){
			/**Rata rata all departemen */
			if($rentang=='Tahun'){
				$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,'Rata-rata' as kelompok,  year(date(waktu_kirim)) as waktu FROM tb_aduan 
											   inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
											   where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) group by year(date(waktu_kirim)) order by waktu_kirim");
			} else if($rentang =='Bulan'){
				$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,'Rata-rata' as kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') as waktu FROM tb_aduan 
												inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
												where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
				
			} else {
				$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,'Rata-rata' as kelompok,  DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') as waktu FROM tb_aduan  
												inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
												where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') group by DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
				
			}
			/**Rata rata all departemen */
		}else if($departemen=='departemen'){
			/**Rata rata all unit in departemen */
			if($rentang=='Tahun'){
				$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,Departemen as kelompok,  year(date(waktu_kirim)) as waktu FROM tb_aduan 
												inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan
												inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
												inner join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen
												where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) 
												group by tb_unit.id_departemen, year(date(waktu_kirim)) order by waktu_kirim");
			} else if($rentang =='Bulan'){
				$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai, Departemen as kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') as waktu FROM tb_aduan 
												inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
												inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
												inner join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen 
												where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') 
												group by tb_unit.id_departemen, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
			} else {
				$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,Departemen as kelompok,  DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') as waktu FROM tb_aduan  
												inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
												inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
												inner join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen
												where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') 
												group by tb_unit.id_departemen,DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
			}
			/**Rata rata  all unit in departemen */
		}else{
			/** rata rata di salah satu departemen */
				if($unit=='all'){
					/**Semua unit di departemen */
					if($rentang=='Tahun'){
						$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,Departemen as kelompok,  year(date(waktu_kirim)) as waktu FROM tb_aduan 
														inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan
														inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
														inner join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen
														where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) and tb_unit.id_departemen='$departemen'
														group by  year(date(waktu_kirim)) order by waktu_kirim");
					} else if($rentang =='Bulan'){
						$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,Departemen as kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') as waktu FROM tb_aduan 
														inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
														inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
														inner join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen
														where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_unit.id_departemen='$departemen'
														group by DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
					} else {
						$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,Departemen as kelompok,  DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') as waktu FROM tb_aduan  
														inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
														inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
														inner join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen
														where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_unit.id_departemen='$departemen'
														group by DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
					}
					/**Semua unit di departemen */
				}else if($unit=='unit'){
					/**Kelompokkkan berdasarkan unit */
					if($rentang=='Tahun'){
						$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,tb_aduan.nama_unit as kelompok,  year(date(waktu_kirim)) as waktu FROM tb_aduan 
														inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan
														inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
														where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) and tb_unit.id_departemen='$departemen'
														group by tb_unit.id_unit, year(date(waktu_kirim)) order by waktu_kirim");
					} else if($rentang =='Bulan'){
						$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,tb_aduan.nama_unit as kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') as waktu FROM tb_aduan 
														inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
														inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
														where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_unit.id_departemen='$departemen'
														group by tb_unit.id_unit, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
					} else {
						$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,tb_aduan.nama_unit as kelompok,  DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') as waktu FROM tb_aduan  
														inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
														inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
														where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_unit.id_departemen='$departemen'
														group by tb_unit.id_unit, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
					}
					/**Kelompokkkan berdasarkan unit */
				}else{
					/**1 unit */
					if($rentang=='Tahun'){
						$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,tb_aduan.nama_unit as kelompok,  year(date(waktu_kirim)) as waktu FROM tb_aduan 
														inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan
														inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
														where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) and tb_aduan.id_unit='$unit'
														group by tb_unit.id_unit, year(date(waktu_kirim)) order by waktu_kirim");
					} else if($rentang =='Bulan'){
						$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,tb_aduan.nama_unit as kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') as waktu FROM tb_aduan 
														inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
														inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
														where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_aduan.id_unit='$unit'
														group by tb_unit.id_unit, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
					} else {
						$data = mysqli_query($koneksi,"SELECT avg(penilaian) as nilai,tb_aduan.nama_unit as kelompok,  DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') as waktu FROM tb_aduan  
														inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
														inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit
														where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_aduan.id_unit='$unit'
														group by tb_unit.id_unit, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
					}
					/**1 unit */
				}
			/** rata rata di salah satu departemen */
		}
	} else {
		if($departemen=='all'){
			/** semua departemen */
			if($rentang=='Tahun'){
				$data = mysqli_query($koneksi,"SELECT count(tb_aduan.id_aduan) as nilai, penilaian as kelompok, year(date(waktu_kirim)) as waktu FROM tb_aduan 
												inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
												where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."'))
												group by penilaian, year(date(waktu_kirim)) order by waktu_kirim");
			} else if($rentang =='Bulan'){
				$data = mysqli_query($koneksi,"SELECT count(tb_aduan.id_aduan) as nilai, penilaian as kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') as waktu FROM tb_aduan  
												inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
												where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') 
												group by penilaian, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
			} else {
				$data = mysqli_query($koneksi,"SELECT count(tb_aduan.id_aduan) as nilai, penilaian as kelompok, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') as waktu FROM tb_aduan  
												inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
												where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') 
												group by penilaian, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
			}
			/** semua departemen */
		}else{
			if($unit=='all'){
				/** Semua unit */
				if($rentang=='Tahun'){
					$data = mysqli_query($koneksi,"SELECT count(tb_aduan.id_aduan) as nilai, penilaian as kelompok, year(date(waktu_kirim)) as waktu FROM tb_aduan 
													inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
													inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit
													where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) and tb_unit.id_departemen = '$departemen'
													group by penilaian, year(date(waktu_kirim)) order by waktu_kirim");
				} else if($rentang =='Bulan'){
					$data = mysqli_query($koneksi,"SELECT count(tb_aduan.id_aduan) as nilai, penilaian as kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') as waktu FROM tb_aduan  
													inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
													inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit
													where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_unit.id_departemen = '$departemen'
													group by penilaian, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
				} else {
					$data = mysqli_query($koneksi,"SELECT count(tb_aduan.id_aduan) as nilai, penilaian as kelompok, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') as waktu FROM tb_aduan  
													inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
													inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit
													where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_unit.id_departemen = '$departemen'
													group by penilaian, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
				}
				/** Semua unit */
			}else{
				/** 1 unit */
				if($rentang=='Tahun'){
					$data = mysqli_query($koneksi,"SELECT count(tb_aduan.id_aduan) as nilai, penilaian as kelompok, year(date(waktu_kirim)) as waktu FROM tb_aduan 
													inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
													where year(date(waktu_kirim))>=year(date('".$from."')) and year(date(waktu_kirim)) <= year(date('".$to."')) and tb_unit.id_departemen = '$departemen'
													group by penilaian, year(date(waktu_kirim)) order by waktu_kirim");
				} else if($rentang =='Bulan'){
					$data = mysqli_query($koneksi,"SELECT count(tb_aduan.id_aduan) as nilai, penilaian as kelompok, DATE_FORMAT(date(waktu_kirim),'%Y-%m') as waktu FROM tb_aduan  
													inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
													where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_aduan.id_unit = '$unit'
													group by penilaian, DATE_FORMAT(date(waktu_kirim),'%Y%m') order by waktu_kirim") or die(mysqli_error($koneksi));
				} else {
					$data = mysqli_query($koneksi,"SELECT count(tb_aduan.id_aduan) as nilai, penilaian as kelompok, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') as waktu FROM tb_aduan  
													inner join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan 
													where date(waktu_kirim)>=date('".$from."') and date(waktu_kirim) <= date('".$to."') and tb_aduan.id_unit = '$unit'
													group by penilaian, DATE_FORMAT(date(waktu_kirim),'%d-%m-%Y') order by waktu_kirim");
				}
				/** 1 unit */
			}
		}
	}
	
	foreach($data as $row){
		$data_kembali["data"][$row['kelompok']][$row['waktu']]=$row['nilai'];
		if(!in_array($row['waktu'], $data_kembali["label"])){
			array_push($data_kembali["label"], $row['waktu']);
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