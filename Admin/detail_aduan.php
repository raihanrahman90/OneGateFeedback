<?php 
$detail='Aduan';
include 'hak_akses.php';
include 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Feedback</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class='table-responsive'>
                    <?php
                    if(isset($_SESSION['langgar'])){
                      if($_SESSION['langgar']=='nerobos'){
                      #masuk tanpa login
                      echo '<div class="alert alert-warning alert-dismissible fade show">
                              Anda tidak memiliki hak akses untuk mengubah data 
                          </div>';
                          #mengembalikan kondisi awal
                          $_SESSION['langgar']='';
                      }
                    }
                    ?>
                <table width="100%" cellspacing="0">
                    <tbody>
          <!-- DataTales Example -->
                    <?php
            				$id = $_GET['id'];///mengambil id dari url
                    #menampilkan data dengan urutan id_progress 
            				$data = mysqli_query($koneksi, "SELECT jenis, nama_unit, pelapor, ket, nama_lokasi, nama_detail_lokasi, status,foto, tindakan, bukti, tb_progress.waktu as waktu_progress, tb_aduan.id_unit as unit, Departemen from tb_aduan
            				left join tb_unit ON tb_aduan.id_unit=tb_unit.id_unit 
                    left join tb_departemen on tb_unit.id_departemen = tb_departemen.id_departemen
            				left join tb_progress ON tb_aduan.id_aduan = tb_progress.id_aduan 
            				left join tb_detail_lokasi on tb_aduan.id_detail_lokasi = tb_detail_lokasi.id_detail_lokasi 
            				left join tb_lokasi on tb_lokasi.id_lokasi = tb_detail_lokasi.id_lokasi 
            				where tb_aduan.id_aduan ='$id' ORDER BY id_progress ASC") or die(mysqli_error($koneksi));
							 $row = mysqli_fetch_assoc($data);
							 $status = $row["status"];
							 $id_unit = $row['unit'];
            				$cek = mysqli_num_rows($data);
              #---kondisi data diecho
							if($cek > 0){
                                   echo"
            				    <div class='row mb-2'>
            				      <div class='col-lg-4'>
            				        <label>Jenis<label>
                                  </div>
                                  <div class='col-lg-8'>
                                    <input type='text' class='form-control' disabled value='".$row['jenis']."'></input>
                                  </div>
                                </div>";
                              if($row['jenis']=='Keluhan'){
                                  echo"
                                  <div class='row mb-2'>
                                  <div class='col-lg-4'>
                                    <label>Departemen <label>
                                          </div>
                                          <div class='col-lg-8'>
                                            <input type='text' class='form-control' disabled value='";
                                            
                                              if(isset($row["Departemen"])){
                                                  echo $row["Departemen"];
                                              }else{
                                                  echo "Departemen sudah dihapus dari database";
                                              }
                                            echo "'></input>
                                          </div>
                                        </div>
                                        <div class='row mb-2'>
                                          <div class='col-lg-4'>
                                              <label>Unit <label>
                                                </div>
                                                <div class='col-lg-8'>
                                                  <input type='text' class='form-control' disabled value='";
                                                  
                                                    if(isset($row["nama_unit"])){
                                                        echo $row["nama_unit"];
                                                    }else{
                                                        echo "Unit sudah dihapus dari database";
                                                    }
                                              echo "'></input>
                                            </div>
                                          </div> ";
                                  }
                                  echo"
                				    <div class='row mb-2'>
                				      <div class='col-lg-4'>
                				        <label>Pelapor<label>
                                      </div>
                                      <div class='col-lg-8'>
                                        <input type='text' class='form-control' disabled value='".$row['pelapor']."'></input>
                                      </div>
                                    </div>
                				    <div class='row mb-2'>
                				      <div class='col-lg-4'>
                				        <label>Lokasi<label>
                                      </div>
                                      <div class='col-lg-8'>
                                        <input type='text' class='form-control' disabled value='";
                                        
                                          if(isset($row["nama_lokasi"])){
                                              echo $row["nama_lokasi"];
                                          }else{
                                              echo "Lokasi sudah dihapus dari database";
                                          }
                                        echo "'></input>
                                      </div>
                                    </div> 
                                 <div class='row mb-2'>
            				      <div class='col-lg-4'>
            				        <label>Detail Lokasi<label>
                                  </div>
                                  <div class='col-lg-8'>
                                    <input type='text' class='form-control' disabled value='";
                                    
                                      if(isset($row["nama_detail_lokasi"])){
                                          echo $row["nama_detail_lokasi"];
                                      }else{
                                          echo "Lokasi sudah dihapus dari database";
                                      }
                                    echo "'></input>
                                  </div>
                                </div>                     
            				    <div class='row mb-2'>
            				      <div class='col-lg-4'>
            				        <label>Keterangan<label>
                                  </div>
                                  <div class='col-lg-8'>
                                    <input type='text' class='form-control' disabled value='".$row['ket']."'></input>
                                  </div>
                                </div>";
                                  
                                    if($row["foto"]!=NULL){
                                    #bukti kerusakan ditampilkan
                                    echo"                 
                                    <div class='row mb-2'>
                                        <div class='col-lg-8 offset-sm-4'>
                                        <!-- Default Card Example -->
                                        <div class='card mb-4'>
                                          <div class='card-header'>
                                            Foto
                                          </div>
                                          <div class='card-body'>
                                          <a href='../gambar/aduan/"
                                          .$row["foto"]."
                                          '>
                                          <img src='../gambar/aduan/"
                                          .$row["foto"].
                                          "' height=200px width='auto'>
                                          </a>
                                          </div>
                                        </div>
                                      </div>
                                      </div>";
                                    ///bukti kerusakan ditampilkan
                                  }
                                  
                      echo"</div>";
                      
                      if($row["tindakan"]!=NULL){
                        #tindakan ditemukan
                        echo"
                        <div class='row'>
                          <div class='col-lg-12'>
                            <div class='card mb-4'>
                              <div class='card-header'>
                                Tindakan
                              </div>
                              <div class='card-body'>
                                  <div class='col-lg-12'>
                                <div class='row'>";
                                $data_progress = mysqli_query($koneksi, "SELECT Nama, tindakan, bukti, tb_akun.id_akun, waktu FROM tb_progress
                                                                         left join tb_akun on tb_akun.id_akun = tb_progress.id_akun
                                                                         where id_aduan = '$id'") or die(mysqli_error($koneksi));
                              while($row = mysqli_fetch_assoc($data_progress)){
                                #perulangan menampilkan semua bukti
                                echo"
                                    <div class='col-sm-4'>
                                      <div class='card shadow mb-4'>
                                        <div class='card-header'>
                                          ".$row["tindakan"]."
                                        </div>
                                        <div class='card-body'>
                                          
                                            <label> Tanggal :".$row["waktu"]."</label><br/>";
                                            if($row['Nama']) echo "<label>Dilakukan oleh :<a href='detail_akun.php?id=".$row['id_akun']."'>".$row['Nama']."</a></label>";
                                          if($row['bukti']) echo"<a href='../gambar/bukti/".$row["bukti"]."' target='_blank'><img src='../gambar/bukti/".$row["bukti"]."' height='auto' width=100%></a>";
                                          echo"
                                        </div>
                                      </div>
                                    </div>";
                                    ///perulangan menampilkan semua bukti
                              }
                              echo"
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>";
                        ///tindakan ditemukan
                      }
                      echo "
                      <a href='#' data-toggle='modal' data-target='#keteranganModal' style='margin-left:10px;' class='btn btn-primary btn-icon-split float-right' >
                        <span class='icon text-white-50'>
                          <i class='fas fa-eye'></i>
                        </span>
                        <span class='text'>Lihat Keterangan Tambahan</span>
                      </a>
                      <!-- Logout Modal-->
                      <div class='modal fade' id='keteranganModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='kembaliModalLabel'>Keterangan Tambahan</h5>
                              <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>×</span>
                              </button>
                            </div>
                              <div class='modal-body'>";
                             $keterangan_tambahan = mysqli_query($koneksi, "SELECT * from tb_keterangan_tambahan
                                  inner join tb_aduan on tb_keterangan_tambahan.id_aduan = tb_aduan.id_aduan
                                  where tb_aduan.id_aduan = '$id'") or die(mysqli_error($koneksi));
                                    if(mysqli_num_rows($keterangan_tambahan)==0){
                                        
                                      echo '<div class="alert alert-warning alert-dismissible fade show">
                                              Tidak ditemukan keterangan tambahan
                                          </div>';   
                                          
                                    }else{
                                        while($row1 = mysqli_fetch_array($keterangan_tambahan)){
                                          echo "
                                          <div class='row'>
                                            <div class='col-lg-12'>
                                                <!-- Default Card Example -->
                                                <div class='card mb-4'>
                                                  <div class='card-header'>
                                                    ".$row1["pertanyaan"]."
                                                  </div>
                                                  <div class='card-body'>
                                                  ";
                                                    if($row1['bukti']) echo "<a href='../gambar/keterangan_tambahan/".$row1['bukti']."' class='pull-right'>Lihat gambar</a> <br>";
                                                  if($row1["jawaban"]){
                                                      echo $row1['jawaban'];
                                                  } else {
                                                      echo 'Belum menerima jawaban';
                                                  }
                                                  echo"
                                                  </div>
                                                </div>
                                              </div>
                                            </div>";
                                        }
                                    }
                             echo"</div>
                                    <div class='modal-footer'>
                                        <button class='btn btn-secondary' type='button' data-dismiss='modal'>Keluar</button>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    if(($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses']=='Admin2')&& $status !='Closed'){
                        #status belum closed & login sebagai customer service
                      echo "<form action='../action/selesai.php' id='my_form' method='post'>
                            <a href='javascript:{}' onclick='lakukan()').submit();' type='submit' value='Tambah' class='btn btn-success btn-icon-split float-right' style='margin-left:10px;'>
                              <span class='icon text-white-50'>
                                <i class='fas fa-check'></i>
                              </span>
                              <span class='text'>Selesai</span>
                            </a>
                            <input type='hidden' value = '$id' name='id'>
                            </form>
                            ";
                        ///status belum closed & login sebagai customer service
                    } 
                    if ($status!='Closed' && (($_SESSION['id_unit']==$id_unit) || $_SESSION['hak_akses']=='Super Admin')){
                      #status belum ditutup & bukan customer service
                      echo "<a href='tindakan.php?id=$id' style='margin-left:10px;' class='btn btn-info btn-icon-split float-right'>
                        <span class='icon text-white-50'>
                          <i class='fas fa-plus'></i>
                        </span>
                        <span class='text'>Tambahkan tindakan</span>
                      </a>

                      <a href='#' data-toggle='modal' data-target='#kembaliModal' class='btn btn-danger btn-icon-split float-right' >
                        <span class='icon text-white-50'>
                          <i class='fas fa-undo'></i>
                        </span>
                        <span class='text'>Kembalikan ke CS</span>
                      </a>
                      <!-- Logout Modal-->
                      <form action='../action/kembali.php' method='post'>
                      <input type='hidden' value = '$id' name='id'>
                      <div class='modal fade' id='kembaliModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='kembaliModalLabel'>Mengembalikan Keluhan ke CS</h5>
                              <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>×</span>
                              </button>
                            </div>
                              <div class='modal-body'>
                                <label>Pilih Keterangan.</label>
                                <select class='form-control form-control-user' name='keterangan'>
                                  <option value='Kurang Data'>Kurang Data</option>
                                  <option value='Bukan unit'>Bukan Tanggung Jawab Saya</option>
                                </select>
                              </div>
                                    <div class='modal-footer'>
                                        <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                                        <button class='btn btn-info' type='submit'>Kirim</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>";
                      ///akhir kasus ditutup
                        }
                    }////kondisi data ditemukan
                    #Data tidak ditemukan
                    else {
            			echo"<tr>
            				<td><label>Data tidak Ditemukan</label></td>
            			</tr>";
            		}
                    ///data tidak ditemukan
                    echo "";
            		?>
            		</tbody>
                  </table>
            </div>
          </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <script type="text/javascript">
        function lakukan(){
          document.getElementById('my_form').submit();
        }
      </script>
      <!-- End of Main Content -->
<?php include 'footer.php';
?>