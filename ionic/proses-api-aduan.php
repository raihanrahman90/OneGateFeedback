<?php
    
    include 'header.php';
	if($postjson==null){
		echo json_encode(array('success'=>false));
	}elseif($postjson['aksi']=='get-aduan'){
	    $data=array();
	    $limit = $postjson['limit'];
	    $offset = $postjson['offset'];
	    $status = $postjson['status'];
	    if($status=='All'){
	        $kondisi_status = '';
	    }else{
    	    $kondisi_status = ' and tb_aduan.status="'.$status.'"';
	    }
	    if($postjson['hak_akses']=='Unit'){
			/**Tutup hak akses unit */
	        if($postjson['status']=='Manager'||$postjson['status']=='Unit'){
				/**Hak akses manager dan unit */
				if($status=='All'){
					$get_jumlah = mysqli_query($koneksi, "SELECT count(id_aduan) as jumlah from tb_aduan 
															where status <> 'Request' and status <> 'Returned' and id_unit='".$postjson['id_unit']."'") 
															or die(mysqli_error($koneksi));
					$get_jumlah = mysqli_fetch_array($get_jumlah);
					$jumlah = $get_jumlah['jumlah'];
				}else{
					$get_jumlah = mysqli_query($koneksi, "SELECT count(id_aduan) as jumlah from tb_aduan 
															where status='$status' and id_unit='".$postjson['id_unit']."'") 
															or die(mysqli_error($koneksi));
					$get_jumlah = mysqli_fetch_array($get_jumlah);
					$jumlah = $get_jumlah['jumlah'];
				}
				$sintax="SELECT * FROM tb_aduan  
				where id_unit = '".$postjson['id_unit']."'".$kondisi_status." order by tb_aduan.id_aduan DESC limit ".$limit." offset ".$offset;
				/**Hak akses manager dan unit */
			}else if($postjson['status_akun']=='Senior Manager'){
				/** Hak akses senior manager */
            	        if($status=='All'){
                    	    $get_jumlah = mysqli_query($koneksi, "SELECT count(tb_aduan.id_aduan) as jumlah from tb_aduan 
                                                                    inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit 
                                                                    inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                                                                    where tb_departemen.id_departemen = '".$postjson['id_departemen']."' and level>=2
                    	                                            and status <> 'Request' and status <> 'Returned'") or die(mysqli_error($koneksi));
                    	    $get_jumlah = mysqli_fetch_array($get_jumlah);
                    	    $jumlah = $get_jumlah['jumlah'];
            	        }else{
                    	    $get_jumlah = mysqli_query($koneksi, "SELECT count(tb_aduan.id_aduan) as jumlah from tb_aduan 
                                                                    inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit 
                                                                    inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
                                                                    where tb_departemen.id_departemen = '".$postjson['id_departemen']."' and level>=2
                    	                                            and status='$status'") or die(mysqli_error($koneksi));
                    	    $get_jumlah = mysqli_fetch_array($get_jumlah);
                	        $jumlah = $get_jumlah['jumlah'];
            	        }
                        $sintax="SELECT tb_aduan.* FROM tb_aduan 
								inner join tb_unit on tb_aduan.id_unit = tb_unit.id_unit 
								inner join tb_departemen on tb_departemen.id_departemen =tb_unit.id_departemen 
								where tb_departemen.id_departemen = '".$postjson['id_departemen']."' and level>=2".$kondisi_status." 
								order by tb_aduan.id_aduan DESC limit ".$limit." offset ".$offset;
				/** Hak akses senior manager */
			} else if($postjson['status_akun']=='AOC Head'){
				/** Hak akses AOC Head */
				if($status=='All'){
					$get_jumlah = mysqli_query($koneksi, "SELECT count(id_aduan) as jumlah from tb_aduan 
														  where status <> 'Request' and status <> 'Returned' and level>=3") or die(mysqli_error($koneksi));
					$get_jumlah = mysqli_fetch_array($get_jumlah);
					$jumlah = $get_jumlah['jumlah'];
				}else{
					$get_jumlah = mysqli_query($koneksi, "SELECT count(id_aduan) as jumlah from tb_aduan 
					                                      where status='$status' and level>=3") or die(mysqli_error($koneksi));
					$get_jumlah = mysqli_fetch_array($get_jumlah);
					$jumlah = $get_jumlah['jumlah'];
				}
				$sintax="SELECT * FROM tb_aduan
						where level>=3".$kondisi_status." order by tb_aduan.id_aduan DESC limit ".$limit." offset ".$offset;
				/** Hak akses AOC Head */
            }else {
				/** Hak akses General Manager */
				if($status=='All'){
					$get_jumlah = mysqli_query($koneksi, "SELECT count(id_aduan) as jumlah from tb_aduan 
															where status <> 'Request' and status <> 'Returned' and level=4") or die(mysqli_error($koneksi));
					$get_jumlah = mysqli_fetch_array($get_jumlah);
					$jumlah = $get_jumlah['jumlah'];
				}else{
					$get_jumlah = mysqli_query($koneksi, "SELECT count(id_aduan) as jumlah from tb_aduan 
															where status='$status' and level=4") or die(mysqli_error($koneksi));
					$get_jumlah = mysqli_fetch_array($get_jumlah);
					$jumlah = $get_jumlah['jumlah'];
				}
				$sintax="SELECT * FROM tb_aduan
				where level=4".$kondisi_status." order by tb_aduan.id_aduan DESC limit ".$limit." offset ".$offset;
				/** Hak akses General Manager */
			}
			/**Tutup hak akses unit */
	    } else {
			/**hak akses super admin dan admin 2 */
	        if($status=='All'){
        	    $get_jumlah = mysqli_query($koneksi, "SELECT count(id_aduan) as jumlah from tb_aduan where status <> 'Request' and status <> 'Returned'") or die(mysqli_error($koneksi));
        	    $get_jumlah = mysqli_fetch_array($get_jumlah);
        	    $jumlah = $get_jumlah['jumlah'];
	        }else{
        	    $get_jumlah = mysqli_query($koneksi, "SELECT count(id_aduan) as jumlah from tb_aduan where status='$status'") or die(mysqli_error($koneksi));
        	    $get_jumlah = mysqli_fetch_array($get_jumlah);
    	        $jumlah = $get_jumlah['jumlah'];
	        }
	        $sintax = "SELECT * from tb_aduan 
						WHERE status <> 'Request' and status <> 'Returned'".$kondisi_status." 
						ORDER BY tb_aduan.id_aduan DESC limit ".$limit." offset ".$offset;
			/**hak akses super admin dan admin 2 */
	    }
		$query=mysqli_query($koneksi, $sintax) or die(mysqli_error($koneksi));
		while($row = mysqli_fetch_array($query)){
			$data[] = array(
				'id_aduan' => $row['id_aduan'],
				'nama_unit' => $row['nama_unit'],
				'status' => $row['status'],
				'perihal'=> $row['perihal'],
				'level'=>$row['level'],
				'urgensi'=>$row['urgensi']
			);
		}
		if($query) $result=json_encode(array('success'=>true, 'jumlah'=>$jumlah, 'result'=>$data));
		else $result = json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi']=='get-id-aduan'){
		$dataaduan =array();
		$query= mysqli_query($koneksi, "SELECT *, tb_aduan.waktu as waktu_aduan, tb_progress.waktu as waktu_progress, now() as sekarang, tb_detail_lokasi.id_lokasi FROM tb_aduan 
										LEFT JOIN tb_progress on tb_aduan.id_aduan = tb_progress.id_aduan 
										LEFT JOIN tb_penilaian on tb_aduan.id_aduan = tb_penilaian.id_aduan
										LEFT JOIN tb_detail_lokasi on tb_aduan.id_detail_lokasi = tb_detail_lokasi.id_detail_lokasi
										WHERE tb_aduan.id_aduan = '$postjson[id_aduan]' order by id_progress desc") or die(mysqli_error($koneksi));
		$jumlahdata = mysqli_num_rows($query);
		if($row = mysqli_fetch_array($query)){
		    if($row['nama_departemen']==null) $nama_departemen='Departemen tidak tersedia';
		    else $nama_departemen=$row['nama_departemen'];
		    if($row['nama_unit']==null) $nama_unit='Unit tidak tersedia';
		    else $nama_unit=$row['nama_unit'];
			$dataaduan[] = array(
			    'jenis'=>$row['jenis'],
				'departemen' => $nama_departemen,
				'nama_unit' => $nama_unit,
				'perihal' => $row['perihal'],
				'keterangan' => $row['ket'],
				'status' => $row['status'],
				'level'=>$row['level'],
				'nama_lokasi' => $row['nama_lokasi'],
				'nama_detail_lokasi' => $row['nama_detail_lokasi'],
				'waktu_aduan' => $row['waktu_aduan'],
				'waktu_progress' => $row['waktu_progress'],
				'bukti' => $row['bukti'],
				'tindakan' => $row['tindakan'],
				'foto'=> $row['foto'],
				'id_detail_lokasi'=>$row['id_detail_lokasi'],
				'id_lokasi'=>$row['id_lokasi'],
				'id_customer'=>$row['id_customer'],
				'sekarang' =>$row['sekarang'],
				'urgensi'=>$row['urgensi'],
				'penilaian'=>$row['penilaian'],
				'ulasan'=>$row['ulasan']
			);
		}
		if($query && $jumlahdata>0) $result= json_encode(array('success'=>true,'result'=>$dataaduan));
		elseif($query) $result =json_encode(array('success'=>false, 'msg'=>'Data tidak ditemukan'));
		else $result= json_encode(array('success'=>false, 'msg'=>'Terjadi Kesalahan'));
		echo $result;
	} elseif($postjson['aksi']=='get-id-aduan-progress'){
	    $id_aduan = $postjson['id_aduan'];
	    $dataaduan = array();
	    $data = mysqli_query($koneksi, "SELECT *, tb_aduan.status as status_progress, now() as sekarang from tb_aduan 
		                        left join tb_progress on tb_aduan.id_aduan = tb_progress.id_aduan
		                        left join tb_detail_lokasi on tb_detail_lokasi.id_detail_lokasi = tb_aduan.id_detail_lokasi
		                        left join tb_lokasi on tb_detail_lokasi.id_lokasi = tb_lokasi.id_lokasi
		                        where tb_aduan.id_aduan = '$id_aduan'");
		if($row = mysqli_fetch_array($data)){
			$dataaduan[] = array(
			    'jenis'=>$row['jenis'],
				'departemen' => $row['Departemen'],
				'nama_unit' => $row['nama_unit'],
				'perihal' => $row['perihal'],
				'keterangan' => $row['ket'],
				'status' => $row['status'],
				'level'=>$row['level'],
				'nama_lokasi' => $row['nama_lokasi'],
				'nama_detail_lokasi' => $row['nama_detail_lokasi'],
				'waktu_aduan' => $row['waktu_aduan'],
				'waktu_progress' => $row['waktu_progress'],
				'bukti' => $row['bukti'],
				'tindakan' => $row['tindakan'],
				'sekarang' => $row['sekarang']
			);
		}
		
		if($data) $result= json_encode(array('success'=>true,'result'=>$dataaduan));
		else $result= json_encode(array('success'=>false));
		echo $result;
		                        
	}elseif($postjson['aksi']=='selesai'){
    	$id_aduan = $postjson['id_aduan'];
    	$id_akun = $postjson['id_akun'];
    	$data = mysqli_query($koneksi, "UPDATE tb_aduan SET status = 'Closed' WHERE id_aduan ='$id_aduan'");
    	if($data) $result = json_encode(array('success'=>true));
    	else $result = json_encode(array('success'=>false));
    	$data = mysqli_query($koneksi, "SELECT nama, email from tb_aduan 
										inner join tb_customer on tb_customer.id_customer = tb_aduan.id_customer where id_aduan='$id_aduan'");
    	$tindakan = mysqli_query($koneksi, "INSERT INTO tb_progress values(0,$id_akun, '$id_aduan', 'Closed', NULL, now())");
    	$data1 = mysqli_fetch_array($data);
    	$nama = $data1['nama'];
    	$email = $data1['email'];
    	include '../pesan/closed_aduan.php';
    	echo $result;
	} elseif($postjson['aksi']=='get-tindakan'){
		$id = $koneksi -> real_escape_string($postjson['id_aduan']);
	    $hasil = array();
	    $query = mysqli_query($koneksi, "SELECT tindakan, bukti, waktu, tb_akun.id_akun, Nama FROM tb_progress 
	                                    left join tb_akun on tb_akun.id_akun = tb_progress.id_akun 
	                                    where id_aduan='$id'");
	    while($row = mysqli_fetch_array($query)){
	        $hasil[] = array(
	            'tindakan'=>$row['tindakan'],
	            'bukti'=>$row['bukti'],
	            'waktu'=>$row['waktu'],
	            'id_akun'=>$row['id_akun'],
	            'nama'=>$row['Nama']
	        );
		}
		$status = mysqli_query($koneksi,"SELECT status from tb_aduan where id_aduan = '$id'");
		$status = mysqli_fetch_array($status)['status'];
	    if($query) $result = json_encode(array('success'=>true,'result'=>$hasil, 'status'=>$status));
	    else $result=json_encode(array('success'=>false));
	    echo $result;
	}elseif($postjson['aksi']=='kembalikan'){
        $id = $postjson['id'];
        $id_akun = $postjson['id_akun'];
        $keterangan = $postjson['keterangan'];
        $data = mysqli_query($koneksi, "UPDATE tb_aduan SET  status ='Returned' WHERE id_aduan ='$id'") or die(mysqli_error($koneksi));
        $data1 = mysqli_query($koneksi, "INSERT INTO tb_progress VALUES(0,$id_akun, $id,'Dikembalikan ke CS dengan keterangan $keterangan',NULL,now())") or die(mysqli_error($koneksi));
        include('../pesan/kembali.php');
        if($data && $data1) $result = json_encode(array('success'=>true));
        else $result =json_encode(array('success'=>false));
        echo $result;
	}elseif($postjson['aksi']=='insert-penilaian'){
		$nilai = $postjson['nilai'];
		$ulasan = $koneksi->real_escape_string($postjson['ulasan']);
		$id_aduan = $koneksi ->real_escape_string($postjson['id_aduan']);		
		$query = mysqli_query($koneksi, "INSERT INTO tb_penilaian value('$id_aduan','$nilai', '$ulasan',0)") or die(mysqli_error($koneksi));
		if($query) $result = json_encode(array('success'=>true));
		else $result = json_encode(array('success'=>false));
		echo $result;
	}elseif($postjson['aksi']=='kirim'){
		$id_aduan = $postjson['id_aduan'];
		$query = mysqli_query($koneksi, "UPDATE tb_aduan set level=0 where id_aduan=$id_aduan") or die(mysqli_error($koneksi));
		if($query) $result= json_encode(array('success'=>true));
		else $result = json_encode(array('success'=>false));
		echo $result;
	}
?>