<?php 
$halaman='Aduan';
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
            				$data = mysqli_query($koneksi, "SELECT Email, jenis, nama_unit, pelapor, ket, nama_lokasi, nama_detail_lokasi, 
                                                            tb_aduan.status, tb_aduan.foto, tindakan, bukti, tb_progress.waktu as waktu_progress, 
                                                            tb_aduan.id_unit as unit, nama_departemen, nama_unit, penilaian, ulasan, perihal,
                                                            nama_perusahaan, gerai, waktu_kejadian, keterangan_kejadian
                                                            from tb_aduan
                                                    left join tb_progress ON tb_aduan.id_aduan = tb_progress.id_aduan 
                                                    left join tb_penilaian on tb_penilaian.id_aduan = tb_aduan.id_aduan
                                                    left join tb_customer on tb_customer.id_customer = tb_aduan.id_customer
                                                    where tb_aduan.id_aduan ='$id' ORDER BY id_progress ASC") or die(mysqli_error($koneksi));
                    $row = mysqli_fetch_assoc($data);
                    $status = $row["status"];
                    $id_unit = $row['unit'];
                          $cek = mysqli_num_rows($data);
                    #---kondisi data diecho
                    if($cek > 0){
                        if($row['penilaian']!=null){
                          /**Menampilkan penilaian bintang */
                          echo"
                          <div class='row mb-2'>
                            <div class='col-lg-4'>
                              <label>Penilaian Customer<label>
                            </div>
                            <div class='col-lg-8'>";
                            for($x = 0; $x < $row['penilaian']; $x++){
                              echo"<span class='penilaian penilaian-checked fa fa-star'></span>";
                            }
                            for($x = 0; $x < 5-$row['penilaian']; $x++){
                              echo"<span class='penilaian fa fa-star'></span>";
                            }
                          echo"
                            </div>
                          </div>
                          ";
                          /**Menampilkan penilaian bintang */
                          /**Menampilkan ulasan customer */
                          echo"
                            <div class='row mb-2'>
                              <div class='col-lg-4'>
                                <label>Ulasan Customer<label>
                              </div>
                              <div class='col-lg-8'>
                                <input type='text' class='form-control' disabled value='".$row['ulasan']."'></input>
                              </div>
                            </div>
                            ";
                          /**Menampilkan ulasan customer */
                          /**Mengupdate data aduan telah dibuka */
                          mysqli_query($koneksi, "update tb_penilaian set open=1 where id_aduan=".$id) or die(mysqli_error($koneksi));
                          /**Mengupdate data aduan telah dibuka */
                        }
                                   echo"
                                <div class='row mb-2'>
                                  <div class='col-lg-4'>
                                    <label>Id Aduan<label>
                                  </div>
                                  <div class='col-lg-8'>
                                    <input type='text' class='form-control' disabled value='".$id."'></input>
                                  </div>
                                </div>
                                <div class='row mb-2'>
                                  <div class='col-lg-4'>
                                    <label>Jenis<label>
                                  </div>
                                  <div class='col-lg-8'>
                                    <input type='text' class='form-control' disabled value='".$row['jenis']."'></input>
                                  </div>
                                </div>
                                ";
                              if($row['jenis']=='Keluhan'){
                                  echo"
                                  <div class='row mb-2'>
                                    <div class='col-lg-4'>
                                      <label>Departemen <label>
                                          </div>
                                          <div class='col-lg-8'>
                                            <input type='text' class='form-control' disabled value='";
                                            
                                              if(isset($row["nama_departemen"])){
                                                  echo $row["nama_departemen"];
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
                				        <label>Perusahaan Pelapor<label>
                              </div>
                              <div class='col-lg-8'>
                                <input type='text' class='form-control' disabled value='".$row['nama_perusahaan']."'></input>
                              </div>
                            </div>
                            <div class='row mb-2'>
                				      <div class='col-lg-4'>
                				        <label>Gerai Perusahaan<label>
                              </div>
                              <div class='col-lg-8'>
                                <input type='text' class='form-control' disabled value='".$row['gerai']."'></input>
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
                                    <label>Perihal<label>
                                  </div>
                                  <div class='col-lg-8'>
                                  <input type='text' class='form-control' disabled value='".$row['perihal']."'></input>
                                  </div>
                                </div>
                                <div class='row mb-2'>
                                  <div class='col-lg-4'>
                                    <label>Keterangan<label>
                                  </div>
                                  <div class='col-lg-8'>
                                    <textarea class='form-control' disabled rows=4>".$row['ket']."</textarea>
                                  </div>
                                </div>
                                <div class='row mb-2'>
                                  <div class='col-lg-4'>
                                    <label>Tanggal Kejadian<label>
                                  </div>
                                  <div class='col-lg-8'>
                                    <input type='text' class='form-control' disabled value='".$row['waktu_kejadian']."'></input>
                                  </div>
                                </div>";
                                  if($row['keterangan_kejadian']){
                                    echo "
                                    <div class='row mb-2'>
                                      <div class='col-lg-4'>
                                        <label>Keterangan Kejadian<label>
                                      </div>
                                      <div class='col-lg-8'>
                                        <textarea class='form-control' disabled rows=4>".$row['keterangan_kejadian']."</textarea>
                                      </div>
                                    </div>
                                    ";
                                  }
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
                                $data_progress = mysqli_query($koneksi, "SELECT Nama, tindakan, bukti, tb_akun.id_akun, waktu, id_progress FROM tb_progress
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
                                            // jika akun ditemukan
                                            if($row['Nama']) echo "<label>Dilakukan oleh :<a href='detail_akun.php?id=".$row['id_akun']."'>".$row['Nama']."</a></label>";
                                            if(file_exists('../gambar/bukti/'.$row['id_progress'].'.pdf')) echo '<br/>Laporan PDF <a href="../gambar/bukti/'.$row['id_progress'].'.pdf" target="_blank">Lihat</a>';
                                            //Jika terdapat foto
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
                    if(($_SESSION['hak_akses']=='Super Admin' || $_SESSION['hak_akses']=='Admin2')&& $status =='Complete'){
                        #status belum closed & login sebagai customer service
                      echo "
                            <a href='#' data-toggle='modal' data-target='#selesaiModal'  style='margin-left:10px;' class='btn btn-success btn-icon-split float-right' >
                              <span class='icon text-white-50'>
                                <i class='fas fa-check'></i>
                              </span>
                              <span class='text'>Selesai</span>
                            </a>
                            <!-- Logout Modal-->
                            <form action='../action/selesai.php' method='post'>
                            <input type='hidden' value = '$id' name='id'>
                            <div class='modal fade' id='selesaiModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='selesaiModalLabel'>Menutup Feedback</h5>
                                    <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                      <span aria-hidden='true'>×</span>
                                    </button>
                                  </div>
                                    <div class='modal-body'>
                                        <label>Nama Admin</label>
                                        <input type='text' class='form-control form-control-user' name='nama' placeholder='Masukkan nama anda' required>
                                        </input>
                                        </div>
                                          <div class='modal-footer'>
                                              <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                                              <button class='btn btn-info' type='submit'>Kirim</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
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

                      <a href='#' data-toggle='modal' data-target='#kembaliModal'  style='margin-left:10px;' class='btn btn-danger btn-icon-split float-right' >
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
                                    <option value='Bukan Tanggung Jawab Unit Saya'>Bukan Tanggung Jawab Unit Saya</option>
                                  </select>
                                  <label>Tambahkan Penjelasan.</label>
                                  <input type='text' class='form-control form-control-user' name='penjelasan' placeholder='Membutuhkan data nomor kursi' required>
                                  </input>
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
                        echo"<a href='laporan.php?id=$id' style='margin-left:10px;' class='btn btn-info btn-icon-split float-right'>
                          <span class='icon text-white-50'>
                            <i class='fas fa-sticky-note'></i>
                          </span>
                          <span class='text'>Buat Laporan</span>
                        </a>";
                        if($status=='Complete' && ($_SESSION['hak_akses']=='Admin2'||$_SESSION['hak_akses']=='Super Admin')){
                          echo"
                          <a href='#' data-toggle='modal' data-target='#kembaliKeUnitModal' class='btn btn-danger btn-icon-split float-right' >
                            <span class='icon text-white-50'>
                              <i class='fas fa-undo'></i>
                            </span>
                            <span class='text'>Kembalikan ke Unit Teknis</span>
                          </a>
                          <!-- Logout Modal-->
                          <form action='../action/kembali_ke_unit_teknis.php' method='post'>
                          <input type='hidden' value = '$id' name='id'>
                          <div class='modal fade' id='kembaliKeUnitModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='kembaliModalLabel'>Mengembalikan Keluhan ke Unit Teknis</h5>
                                  <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>×</span>
                                  </button>
                                </div>
                                  <div class='modal-body'>
                                      <label>Nama Admin</label>
                                      <input type='text' class='form-control form-control-user' name='nama' placeholder='Masukkan Nama Anda' required>
                                      </input>
                                      <label>Keterangan</label>
                                      <input type='text' class='form-control form-control-user' name='keterangan' placeholder='Masukkan Keterangan' required>
                                      </input>
                                      </div>
                                        <div class='modal-footer'>
                                            <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                                            <button class='btn btn-info' type='submit'>Kirim</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>";
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