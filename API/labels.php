<?php
	include '../koneksi.php';
	$data_kembali = array();
	$rentang = $_POST['rentang'];
	$from = $_POST['from'];
	$to = $_POST['to'];
	if($rentang=='Tahun'){
		$data = mysqli_query($koneksi, "SELECT year(waktu) from tb_aduan where waktu>'$from' and waktu<'$to' GROUP BY year(waktu)");
		foreach ($data as $row) {
			$data_kembali[] = (int)$row['year(waktu)'];
		}
	} else if($rentang == 'Bulan'){
		$data = mysqli_query($koneksi, "SELECT month(waktu) from tb_aduan where waktu>'$from' and waktu<'$to' GROUP BY month(waktu)");		
		foreach ($data as $row) {
			$data_kembali[] = (int)$row['month(waktu)'];
		}
	}else if($rentang == 'Hari'){
		$data = mysqli_query($koneksi, "SELECT day(waktu) from tb_aduan where waktu>'$from' and waktu<'$to' GROUP BY day(waktu)");
		foreach ($data as $row) {
			$data_kembali[] = (int)$row['day(waktu)'];
		}
	}
	$a=0;
	echo json_encode($data_kembali);	
?>